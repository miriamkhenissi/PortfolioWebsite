<?php $title = "Contact"; ?>
<?php $show_tools_menu = true; ?>
<?php require("header.php"); ?>
<main>
    <div class="container">
        <div class="contact-form">
            <div class="contact-image">
                <img src="img/envelope.svg" alt="envelope_contact"/>
            </div>
            <form action="contactform.php" method="post">
                <h3>Drop Us a Message</h3>
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Your Name *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="mail" class="form-control" placeholder="Your Email *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="subject" class="form-control" placeholder="Subject *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn-purple" value="Send Message" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea name="txtMsg" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;"></textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
<?php require("footer.php"); ?>