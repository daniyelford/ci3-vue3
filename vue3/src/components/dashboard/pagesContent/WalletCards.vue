<template>
    <div class="wallet-page">
        <h1>کیف پول من</h1>
        <TransactionsSection />
        <BankCardsSection />
        <WithdrawalsSection />
        <TokensAmountSection />
        <DiscountCardsSection />
    </div>
</template>

<script setup>
    import TransactionsSection from '@/components/dashboard/pagesContent/wallet/TransactionsSection.vue'
    import BankCardsSection from '@/components/dashboard/pagesContent/wallet/BankCardsSection.vue'
    import WithdrawalsSection from '@/components/dashboard/pagesContent/wallet/WithdrawalsSection.vue'
    import TokensAmountSection from '@/components/dashboard/pagesContent/wallet/TokensAmountSection.vue'
    import DiscountCardsSection from '@/components/dashboard/pagesContent/wallet/DiscountCardsSection.vue'
</script>

<style scoped>
    .wallet-page {
        padding: 20px;
    }
</style>
