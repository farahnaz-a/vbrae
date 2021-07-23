@extends('layouts.frontend')

@section('title')
    {{ config('app.name') }} - checkout 
@endsection

@section('content')
<style>
    .form-control:focus { 
        color :#fff; 
    }
    .form-control { 
        color :#fff; 
    }
    .hide {
        display: none;
    }
</style>
 <div class="container">
    <div class="content-body">
        <div class="page-content search-section">
       
            <div class="row">
                <div class="col-md-8 col-md-offset-3 m-auto">
                   <div class="panel panel-default credit-card-box">
                      <div class="panel-heading display-table" >
                         <div class="row display-tr" >
                            <h3 class="panel-title display-td" >Payment Details</h3>
                         </div>
                      </div>
                      <div class="panel-body">
                         @if (Session::has('success'))
                         <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                         </div>
                         @endif
                         <form
                            role="form"
                            action="{{ route('stripe.post') }}"
                            method="post"
                            class="require-validation"
                            data-cc-on-file="false"
                            data-stripe-publishable-key="pk_test_JI1oswkOtt37AbIiGwNB6kYC003I2xAVKx"
                            id="payment-form">
                            @csrf
                            <div class='form-row row'>
                               <div class='col-xs-12 form-group required'>
                                  <label class='control-label py-3'>Name on Card</label> <input style="background: #4444;"
                                     class='form-control py-3' size='4' type='text'>
                               </div>
                            </div>
                            <div class='form-row row'>
                               <div class='col-xs-12 form-group required'>
                                  <label class='control-label py-3'>Card Number</label> <input
                                     autocomplete='off' style="background: #4444;" class='form-control py-3 card-number' size='20'
                                     type='text'>
                               </div>
                            </div>
                            <div class='form-row row'>
                               <div class='col-xs-12 col-md-4 form-group cvc required'>
                                  <label class='control-label py-3'>CVC</label> <input autocomplete='off'
                                     class='form-control card-cvc py-3' style="background: #4444;" placeholder='ex. 311' size='4'
                                     type='text'>
                               </div>
                               <div class='col-xs-12 col-md-4 form-group expiration required'>
                                  <label class='control-label py-3'>Expiration Month</label> <input
                                     class='form-control card-expiry-month py-3' style="background: #4444;" placeholder='MM' size='2'
                                     type='text'>
                               </div>
                               <div class='col-xs-12 col-md-4 form-group expiration required'>
                                  <label class='control-label py-3'>Expiration Year</label> <input
                                     class='form-control card-expiry-year py-3' style="background: #4444;" placeholder='YYYY' size='4'
                                     type='text'>
                               </div>
                            </div>
                            <div class='form-row row'>
                               <div class='col-md-12 error form-group hide pt-4'>
                                  <div class='alert-danger alert'>Please correct the errors and try
                                     again.
                                  </div>
                               </div>
                            </div>
                            <div class="row">
                               <div class="col-xs-12 pt-3">
                                   <input type="hidden" value="{{ $data->id }}" name="listing_id">
                                  <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now (€{{ $data->price }})</button>
                               </div>
                            </div>
                         </form>
                      </div>
                   </div>
                </div>
             </div>

 </div>
 </div>
 </div>

@endsection

@section('js')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
   <script type="text/javascript">
      $(function() {
    var $form = $(".require-validation");
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]',
                'input[type=text]', 'input[type=file]',
                'textarea'
            ].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid = true;
        $errorMessage.addClass('hide');
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('hide');
                e.preventDefault();
            }
        });
        if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
        }
    });
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
});
   </script>
@endsection