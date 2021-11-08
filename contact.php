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
                <h1>Drop me a message</h1>
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
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea name="txtMsg" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <input type="submit" name="submit" class="btn-contact" value="Send Message" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
<?php require("footer.php"); ?>