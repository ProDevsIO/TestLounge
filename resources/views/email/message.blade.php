<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Mozilla</title>

    <style>

        body {margin:0; padding:0; -webkit-text-size-adjust:none; -ms-text-size-adjust:none;} img{line-height:100%; outline:none; text-decoration:none; -ms-interpolation-mode: bicubic;} a img{border: none;} #backgroundTable {margin:0; padding:0; width:100% !important; } a, a:link{color:#2A5DB0; text-decoration: underline;} table td {border-collapse:collapse;} span {color: inherit; border-bottom: none;} span:hover { background-color: transparent; }

    </style>

    <style>
        .scalable-image img{max-width:100% !important;height:auto !important}.button a{transition:background-color .25s, border-color .25s}.button a:hover{background-color:#e1e1e1 !important;border-color:#0976a5 !important}@media only screen and (max-width: 400px){.preheader{font-size:12px !important;text-align:center !important}.header--white{text-align:center}.header--white .header__logo{display:block;margin:0 auto;width:118px !important;height:auto !important}.header--left .header__logo{display:block;width:118px !important;height:auto !important}}@media screen and (-webkit-device-pixel-ratio), screen and (-moz-device-pixel-ratio){.sub-story__image,.sub-story__content{display:block
        !important}.sub-story__image{float:left !important;width:200px}.sub-story__content{margin-top:30px !important;margin-left:200px !important}}@media only screen and (max-width: 550px){.sub-story__inner{padding-left:30px !important}.sub-story__image,.sub-story__content{margin:0 auto !important;float:none !important;text-align:center}.sub-story .button{padding-left:0 !important}}@media only screen and (max-width: 400px){.featured-story--top table,.featured-story--top td{text-align:left}.featured-story--top__heading td,.sub-story__heading td{font-size:18px !important}.featured-story--bottom:nth-child(2) .featured-story--bottom__inner{padding-top:10px
        !important}.featured-story--bottom__inner{padding-top:20px !important}.featured-story--bottom__heading td{font-size:28px !important;line-height:32px !important}.featured-story__copy td,.sub-story__copy td{font-size:14px !important;line-height:20px !important}.sub-story table,.sub-story td{text-align:center}.sub-story__hero img{width:100px !important;margin:0 auto}}@media only screen and (max-width: 400px){.footer td{font-size:12px !important;line-height:16px !important}}
        @media screen and (max-width:600px) {
            table[class="columns"] {
                margin: 0 auto !important;float:none !important;padding:10px 0 !important;
            }
            td[class="left"] {
                padding: 0px 0 !important;
            }
        }
    </style>

</head>

<body style="background: #e1e1e1;font-family:Arial, Helvetica, sans-serif; font-size:1em;"><style type="text/css">
    div.preheader
    { display: none !important; }
</style>

<table id="backgroundTable" width="640px" cellspacing="0" cellpadding="0" border="0" style="background:#e1e1e1;">
    <tr>
        <td class="body" align="center" valign="top" style="background:#e1e1e1;" width="100%">
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <td width="640">
                    </td>
                </tr>
                <tr>
                    <td class="main" width="640" align="center" style="padding: 0 10px;">
                        <table style="min-width: 100%" class="stylingblock-content-wrapper" width="100%" cellspacing="0" cellpadding="0"><tr><td class="stylingblock-content-wrapper camarker-inner"><table cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="640" align="left">
                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td class="header header--left" style="padding: 20px 10px;" align="left">
                                                          
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table></td></tr></table>
                                    <table style="min-width: 100%;  " class="stylingblock-content-wrapper" width="100%" cellspacing="0" cellpadding="0"><tr><td class="stylingblock-content-wrapper camarker-inner"><table class="featured-story featured-story--top" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td style="padding-bottom: 20px;">
                                                <table cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td class="featured-story__inner" style="background: #fff;">
                                                            <table cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    <td class="scalable-image" width="640" style="font-family: Geneva, Tahoma, Verdana, sans-serif; font-size: 14px; line-height: 22px;padding: 32px 30px 45px;" align="center">
                                                                        <a href="/" ><img src="{{ public_path()}}/images/logo.png" alt="" style="display: block; border: 0; max-width: 80%; height: auto; padding-top:20%" width="320"></a>
                                                                        The Testing Lounge<br>
                                                                        Kemp House, 152-160 City Road<br>
                                                                        London, EC1V 2NX<br>
                                                                        Email : info@thetestinglounge.com<br>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="featured-story__content-inner" style="padding: 32px 30px 45px;">
                                                                        <table cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td class="featured-story__heading featured-story--top__heading" style="background: #fff;" width="640" align="left">
                                                                                    <table cellspacing="0" cellpadding="0">
                                                                                        <tr>
                                                                                            <td style="font-family: Geneva, Tahoma, Verdana, sans-serif; font-size: 22px; color:blue;" width="400" align="left">
                                                                                    
                                                                                                @if($test->status == 1)
 
                                                                                                    Inconceivable test result 

                                                                                                @elseif($test->status == 2)
 
                                                                                                    Positive test result 
                                                                                                @elseif($test->status == 3)
 
                                                                                                    Negative test result 

                                                                                                @endif
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="featured-story__copy" style="background: #fff;" width="100%" align="left">
                                                                                    <table cellspacing="0" cellpadding="0">
                                                                                        <tr>
                                                                                        @if($test->status == 1)
    
                                                                                            <h4 style="">Your coronavirus test result is unclear. It is not possible to say if you had the virus when the test was done. </h4><br><br>
                                                                                            
                                                                                            You must self-isolate for 10 days from the day after your test date. <br><br>
                                                                                            
                                                                                            You may choose to take another test, and if it comes back with a negative result, you no longer need to self-isolate. You may be contacted to check that you are self-isolating <br><br>
                                                                                            
                                                                                            
                                                                                            Get another test as soon as possible if this happens. You can get a test to check for coronavirus on <a href="www.thetestinglounge.com"> www.thetestinglounge.com</a><br><br>
                                                                                            
                                                                                            
                                                                                            
                                                                                            For further information please visit the government’s guidelines found below: <br><br>
                                                                                            
                                                                                            <a href="https://www.nhs.uk/conditions/coronavirus-covid-19/testing/test-results/negative-test-result/">https://www.nhs.uk/conditions/coronavirus-covid-19/testing/test-results/negative-test-result/</a>  
 
                                                                                            
                                                                                        @elseif($test->status == 2)
                                                                                       
 
                                                                                            <h4 style="">Your coronavirus test result is positive. This means that you probably have the virus. </h4><br><br>
                                                                                            
                                                                                            Even if you have not had symptoms of coronavirus you must now self-isolate for 10 days from the day after your test date. <br><br>
                                                                                            
                                                                                            You must obtain, take and return a free follow up polymerase chain reaction (PCR) test from NHS Test and Trace to confirm this. You can obtain your confirmatory PCR test by visiting  <a href="gov.uk/get">gov.uk/get</a> - coronavirus-test or by calling 119.<br><br> 
                                                                                            
                                                                                            
                                                                                            This test will be free of charge and will be sent to you as a home test kit. <br><br>
                                                                                            
                                                                                            You must take this test in accordance with this notice. If this confirmatory test is negative, you no longer need to self-isolate. <br><br>
                                                                                            
                                                                                            You may be contacted for contact tracing and to check that you, and those who you live or are travelling with, are self-isolating. <br><br>
                                                                                            
                                                                                            You must not travel, including to leave the UK, during self-isolation. Contact 111 if you need medical help. In an emergency dial 999 <br><br>
                                                                                            
                                                                                            
                                                                                            For more information please refer to the government’s guidelines found below: <br><br>
                                                                                            
                                                                                            <a href="https://www.nhs.uk/conditions/coronavirus-covid-19/testing/test-results/negative-test-result/">https://www.nhs.uk/conditions/coronavirus-covid-19/testing/test-results/negative-test-result/</a>  

                                                                                        @elseif($test->status == 3)

                                                                                          <td style="font-family: Geneva, Tahoma, Verdana, sans-serif; font-size: 16px; line-height: 22px; color: #555555; padding-top: 16px;" align="left">
                                                                                            <h4 style="">Your coronavirus (COVID-19) test result is negative. It is likely that you did not have the virus when the test was done. </h4><br>
                                                                                            
                                                                                            You are not required to self-isolate. <br><br>
                                                                                            
                                                                                            
                                                                                            You should self-isolate again if you get symptoms of coronavirus (COVID-19) – get an NHS coronavirus (COVID-19) test from www.gov.uk/get-coronavirus-test and self-isolate until you get the results.<br> <br>
                                                                                            
                                                                                            
                                                                                            For advice on when you might need to self-isolate and what to do, go <br>
                                                                                            to  <a href="www.nhs.uk/conditions/coronavirus-covid-19">www.nhs.uk/conditions/coronavirus-covid-19</a>  and read ‘Self-isolation and treating symptoms’ <br><br>
                                                                                            
                                                                                            
                                                                                            For more information please follow the government’s guidelines found below: <br>
                                                                                            
                                                                                           <a href="https://www.nhs.uk/conditions/coronavirus-covid-19/testing/test-results/negative-test-result/">https://www.nhs.uk/conditions/coronavirus-covid-19/testing/test-results/negative-test-result/</a>  


                                                                                        @endif
                                                                                           
                                                                                        <br><br>
                                                                                        Thank You
                                                                                        <br><br>

                                                                                        TheTestingLounge
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>

                                                                        </table>
                                                                    </td>
                                                                </tr>

                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table></td></tr></table></td>
                </tr>

            </table>
        </td>
    </tr>
</table>

<!-- Exact Target tracking code -->


</custom></body>
</html>
