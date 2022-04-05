<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-header mt-4">Payment With Stripe</div>
                <div class="card d-flex justify-content-center">
                    <stripe-checkout
                        ref="checkoutRef"
                        :pk="publishableKey"
                        :sessionId="sessionId"
                        
                    />
                    <button class="mt-3 mb-3 w-50 btn btn-info" @click="submit">Pay now!</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { StripeCheckout } from '@vue-stripe/vue-stripe';
    export default {
    components: {
        StripeCheckout,
    },
    data(){
        return {
            publishableKey:'pk_test_51KTo5AFToplT6ee4bo5gkmwdOWbfXk2OJAExAHtrTDsr8rlosOxo5Vq9psA8DxtiY2ZIgZwoTB1VSeua6oChbYXK00ftROsZVD',
            sessionId:null,
        }
    },
    created(){
        this.getSession();
    },
    methods:{
       
        submit () {
            // You will be redirected to Stripe's secure checkout page
            this.$refs.checkoutRef.redirectToCheckout();
        },
        getSession(){
            return axios.get('/payment/session').then(response => {
                this.sessionId = response.data.id;
            }).catch(error => console.error(error))
        },
    }
};

</script>
