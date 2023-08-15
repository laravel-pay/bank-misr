<script src="{{ $checkout_url }}" data-error="{{ $fail_url  }}"  data-cancel="{{ $fail_url }}"></script>
<script type="text/javascript">
window.onload = function() {
    Checkout.showPaymentPage();
};

Checkout.configure({
    session: {
        id: "{{ $session_id }}"
    },
    interaction: {
        merchant: {
            name: "{{ $merchant_name }}",
        }

    }
});
</script>
