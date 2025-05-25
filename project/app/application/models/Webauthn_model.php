<?php

use Webauthn\PublicKeyCredentialSource;
use Webauthn\TrustPath\EmptyTrustPath;
use Webauthn\TrustPath\CertificateTrustPath;
use Symfony\Component\Uid\Uuid;

class Webauthn_model extends CI_Model
{
    private $tbl = 'user_credentials';

    public function findAll(): array
    {
        $query = $this->db->get($this->tbl);
        $result = [];
        foreach ($query->result() as $row) {
            $trustPath = match($row->trust_path) {
                'empty' => new EmptyTrustPath(),
                default => ($row->type === 'fido2') 
                    ? new CertificateTrustPath(['fido2_certificate_bytes'])
                    : new CertificateTrustPath([]),
            };
            $result[] = new PublicKeyCredentialSource(
                $row->credential_id,
                $row->type,
                json_decode($row->transports, true),
                $row->attestation_type,
                $trustPath,
                Uuid::fromString($row->aaguid),
                $row->public_key,
                $row->user_handle,
                $row->counter
            );
        }
        return $result;
    }

    public function saveCredential(PublicKeyCredentialSource $source,int $user_id)
    {
        $trustPath = $source->trustPath instanceof EmptyTrustPath ? 'empty' : 'certificate';
        $certificateType = ($source->trustPath instanceof CertificateTrustPath && $this->isFido2Certificate($source->trustPath)) ? 'fido2' : 'certificate';
        $data = [
            'user_id'          => $user_id,
            'credential_id'    => $source->publicKeyCredentialId,
            'type'             => $source->type,
            'transports'       => json_encode($source->transports),
            'attestation_type' => $source->attestationType,
            'trust_path'       => $trustPath,
            'certificate_type' => $certificateType,
            'aaguid'           => $source->aaguid->toRfc4122(),
            'public_key'       => $source->credentialPublicKey,
            'counter'          => $source->counter,
            'user_handle'      => $source->userHandle,
        ];
        $this->db->insert($this->tbl, $data);
    }

    public function findOneByCredentialId(string $credentialId): ?PublicKeyCredentialSource
    {
        $query = $this->db->get_where($this->tbl, ['credential_id' => $credentialId]);
        $row = $query->row();
        if (!$row) {
            return null;
        }
        $trustPath = match($row->trust_path) {
            'empty' => new EmptyTrustPath(),
            default => ($row->certificate_type === 'fido2') 
                ? new CertificateTrustPath(['fido2_certificate_bytes'])
                : new CertificateTrustPath([]),
        };
        return new PublicKeyCredentialSource(
            $row->credential_id,
            $row->type,
            json_decode($row->transports, true),
            $row->attestation_type,
            $trustPath,
            Uuid::fromString($row->aaguid),
            $row->public_key,
            $row->user_handle,
            $row->counter
        );
    }

    private function isFido2Certificate(CertificateTrustPath $trustPath): bool
    {
        return $trustPath->isValid() && $trustPath->hasFido2Attributes();
    }

    public function findUserByUserHandle(string $userHandle)
    {
        $query = $this->db->limit(1)->get_where($this->tbl, ['user_handle' => $userHandle]);
        $row = $query->row();
        if (!$row) {
            return null;
        }
        return (object) [
            'id' => $row->user_id
        ];
    }

    public function findAllByUserId(int $userId): array
    {
        $query = $this->db->get_where($this->tbl, ['user_id' => $userId]);
        $result = [];
        foreach ($query->result() as $row) {
            $trustPath = match($row->trust_path) {
                'empty' => new EmptyTrustPath(),
                default => ($row->certificate_type === 'fido2') 
                    ? new CertificateTrustPath(['fido2_certificate_bytes'])
                    : new CertificateTrustPath([]),
            };
            $result[] = new PublicKeyCredentialSource(
                $row->credential_id,
                $row->type,
                json_decode($row->transports, true),
                $row->attestation_type,
                $trustPath,
                Uuid::fromString($row->aaguid),
                $row->public_key,
                $row->user_handle,
                $row->counter
            );
        }
        return $result;
    }

}
