<?php

use Webauthn\PublicKeyCredentialSource;
use Webauthn\TrustPath\EmptyTrustPath;
use Webauthn\TrustPath\CertificateTrustPath;
use Symfony\Component\Uid\Uuid;

class Webauthn_model extends CI_Model
{
    private $tbl = 'user_credentials';

    public function saveCredential(PublicKeyCredentialSource $source)
    {
        // تبدیل trustPath به فرمت قابل ذخیره‌سازی
        $trustPath = $source->trustPath instanceof EmptyTrustPath ? 'empty' : 'certificate';

        // اگر trustPath از نوع Certificate باشد و مربوط به FIDO2 باشد، آن را به عنوان FIDO2 ذخیره کن
        $certificateType = ($source->trustPath instanceof CertificateTrustPath && $this->isFido2Certificate($source->trustPath)) ? 'fido2' : 'certificate';

        $data = [
            'user_id'          => $_SESSION['id'], // به یوزر لاگین شده بچسبون (تغییر بده!)
            'credential_id'    => $source->publicKeyCredentialId,
            'type'             => $source->type,
            'transports'       => json_encode($source->transports),
            'attestation_type' => $source->attestationType,
            'trust_path'       => $trustPath, // ذخیره کردن نوع trustPath
            'certificate_type' => $certificateType, // ذخیره نوع FIDO2 یا Certificate
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

        // بازیابی trustPath و تبدیل آن به شیء مناسب
        if ($row->trust_path === 'empty') {
            $trustPath = new EmptyTrustPath();
        } else {
            // اگر نوع گواهی FIDO2 باشد، آن را به عنوان FIDO2 تشخیص بده
            $trustPath = ($row->certificate_type === 'fido2') ? new CertificateTrustPath(['fido2_certificate_bytes']) : new CertificateTrustPath([]);
        }

        return new PublicKeyCredentialSource(
            $row->credential_id,
            $row->type,
            json_decode($row->transports, true),
            $row->attestation_type,
            $trustPath,
            Uuid::fromString($row->aaguid), // تبدیل به Uuid
            $row->public_key,
            $row->counter,
            $row->user_handle
        );
    }

    public function findAllForUser(string $userHandle): array
    {
        $query = $this->db->get_where($this->tbl, ['user_handle' => $userHandle]);
        $result = [];

        foreach ($query->result() as $row) {
            // بازیابی trustPath و تبدیل آن به شیء مناسب
            if ($row->trust_path === 'empty') {
                $trustPath = new EmptyTrustPath();
            } else {
                // اگر نوع گواهی FIDO2 باشد، آن را به عنوان FIDO2 تشخیص بده
                $trustPath = ($row->certificate_type === 'fido2') ? new CertificateTrustPath(['fido2_certificate_bytes']) : new CertificateTrustPath([]);
            }

            $result[] = new PublicKeyCredentialSource(
                $row->credential_id,
                $row->type,
                json_decode($row->transports, true),
                $row->attestation_type,
                $trustPath,
                Uuid::fromString($row->aaguid), // تبدیل به Uuid
                $row->public_key,
                $row->counter,
                $row->user_handle
            );
        }

        return $result;
    }

    public function updateCounter(string $credentialId, int $counter)
    {
        $this->db->where('credential_id', $credentialId);
        $this->db->update($this->tbl, ['counter' => $counter]);
    }

    // تابع کمکی برای شناسایی FIDO2
    private function isFido2Certificate(CertificateTrustPath $trustPath): bool
    {
        // اینجا می‌توانید شرایط خود را برای شناسایی گواهی FIDO2 اضافه کنید
        // مثلا بررسی مشخصات یا بررسی فیلد خاصی در trustPath
        return true; // برای نمونه همیشه به عنوان FIDO2 در نظر گرفته شده
    }
}
