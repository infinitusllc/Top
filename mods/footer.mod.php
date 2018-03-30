<?php include "includes/get_generics.inc.php"; ?>

<div class="rd-google-map margin-negative-top box-hover">
</div>

<footer class="page-footer text-md-left text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <!-- REVIEW FORM -->
                <form id="review-form" action="includes/make_review.inc.php" method="post" accept-charset="UTF-8"
                      style="text-align: center; margin-bottom: 20px; margin-top: 100px">
                    <p style="color: darkgray; margin-bottom: 10px;"> <strong> დაგვიტოვეთ რევიუ </strong></p>
                    <input name="e_mail" placeholder="ი-მეილი" style="border: solid grey; outline: grey; margin-bottom: 10px;">
                    <input name="subject" placeholder="საკითხი" style="border: solid grey; outline: grey;margin-bottom: 10px"">
                    <textarea name="review" placeholder="რევიუ" style="border: solid grey; outline: grey; width: 80%; height: 100px">რევიუ</textarea> <br><br>
                    <input type="submit" name="submit" value="რევიუს დატოვება" style="outline: gray; border: solid gray; padding: 10px">
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