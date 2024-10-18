
<div>

</div>
<footer class="content-info bg-badge-sale w-full">
    <div class="flex flex-col-reverse md:flex-row  justify-between">
        <!-- Sidebar sekcja -->
        <div class="flex flex-1 flex-col sm:flex-row text-white bg-black px-20 sm:px-0">
            <div class="w-full min-w-64 pt-10 sm:pl-10 space-y-4">
                <h2 class="font-cormorant font-semibold text-3xl mb-4">O nas</h2>
                @php(dynamic_sidebar('footer_service_sidebar'))
                <div class="flex items-center footer-social">
                    @php(dynamic_sidebar('topmenu_social'))
            </div>
            </div>
            <div class="w-full min-w-64 pt-10 p-4 text-right sm:text-left">
                <h2 class="font-cormorant font-semibold text-3xl mb-4">Popularne kategorie</h2>
                @php(dynamic_sidebar('footer_menu_sidebar'))
            </div>
        </div>
        <!-- Newsletter sekcja -->
        <div class="flex-1 bg-grey-10 w-full  p-10 md:max-w-[500px]">
            <p class="font-cormorant font-semibold text-4xl pb-4">Zaoszczędź 10% na następne zamówienie</p>
            <p class="pb-8">Zapisz się do naszego newslettera i odkryj świat wyjątkowych dekoracji papierowych na każdą imprezę! Otrzymaj prezent powitalny od nas i bądź na bieżąco z najnowszymi trendami i promocjami!</p>
            <form method="post" action="#" id="footer_signup"
                accept-charset="UTF-8" class="pb-4">
                <div class="flex gap-4 flex-wrap">
                    <div class="input relative">
                        <input type="email" id="k_id_email" name="email" class="relative border-2 border-black" placeholder="twój email" required="">
                        <label for="k_id_email" class="hidden top-0 z-20">Your e-mail</label>
                    </div>

                    <div class=" ">
                        <button type="submit" class="p-2 btn btn-secondary btn-black btn-background-slide ">Subscribe</button>
                    </div>
                </div>
                <div class="klaviyo_messages">
                    <div class="form__banner banner banner--success success_message"
                        style="display:none;flex-direction:column;">
                    </div>
                    <div class="form__banner banner banner--error error_message" style="display:none;">
                    </div>
                </div>
            </form>
            {{-- <p class="font-thin text-grey-60"><small>* By clicking "Subscribe", you consent to receive emails
                    from PAPER &amp; TEA. We expect to contact you approximately 1-2 times a month. I further
                    consent to the transfer of my data to the CRM provider (Klaviyo Inc, 125 Summer Street, Boston,
                    Massachusetts 02111, United States). You can always withdraw your consent by clicking the
                    unsubscribe link in the messages you receive.</small></p> --}}
         
        </div>
      </div>
      <div class="bg-grey-20  w-full">
        <div class="container mx-auto p-5">
          <p class="text-end">
            Kreatywna Pracownia Papieru

          </p>
        </div>
      </div>
</footer>
