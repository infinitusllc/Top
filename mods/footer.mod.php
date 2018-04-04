<?php include "includes/get_generics.inc.php"; ?>

<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d965.483649673611!2d44.74125384763843!3d41.721410625777324!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe33e59b57865d3a5!2sTop+Travel!5e0!3m2!1sen!2sge!4v1522770797373" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
<footer class="page-footer text-md-left text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <!-- REVIEW FORM -->
                <form id="review-form" action="includes/make_review.inc.php" method="post" accept-charset="UTF-8"
                      style="text-align: left; margin-bottom: 20px; margin-top: 100px">
                    <p style="color: darkgray; margin-bottom: 10px;"> <h4>დაგვიტოვეთ რევიუ </h4></p>
                    <input name="e_mail" placeholder="ი-მეილი" style="margin-bottom: 10px;border: 1px solid #6f588a;width: 450px;color: #9f9f9f;font-weight: normal;font-size: 15px;height: 30px;padding-left: 10px;"><br/>
                    <input name="subject" placeholder="საკითხი" style="margin-bottom: 10px;border: 1px solid #6f588a;width: 450px;color: #9f9f9f;font-weight: normal;font-size: 15px;height: 30px;padding-left: 10px;">
                    <textarea name="review" placeholder="რევიუ" style="margin-bottom: 10px;border: 1px solid #6f588a;width: 450px;color: #9f9f9f;font-weight: normal;font-size: 15px;height: 100px;padding-left: 10px;">რევიუ</textarea> <br/>
                    <input type="submit" name="submit" value="რევიუს დატოვება" style="padding: 10px;background-color: #6f588a;color: white;">
                </form>
                <!-- REVIEW FORM -->
            </div>
            <div class="col-md-5">
                <address class="contact-info">
                    <h4> <?php echo $generics['contact'][$lang_key]['title'];  ?> </h4>
                    <?php echo $generics['contact'][$lang_key]['intro'];  ?>
                </address>
            </div>
            <div class="col-md-2">
                <ul class="inline-list text-center text-lg-left">
                    <li>
                        <a class="icon-xs fa-facebook" href="#"></a>
                    </li>
                    <li>
                        <a class="icon-xs fa-google-plus" href="#"></a>
                    </li>
                    <li>
                        <a class="icon-xs fa-linkedin" href="#"></a>
                    </li>
                    <li>
                        <a class="icon-xs fa-twitter" href="#"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Coded by crash -->
</footer>