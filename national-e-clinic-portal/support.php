<div id="support-container">
    <div id="triangle"></div>
    <div class="row gx-3 gy-5">
        <div class="col-6">
            <div class="p-3" id="get-in-touch">
                <div id="git-title">
                    <p>Get in touch </p>
                    <p>with us</p>
                </div>

                <div id="git-slogan">
                    <p>Want to get in touch? We'd be glad to hear from you. Here's how you can reach us.</p>
                </div>

                <div id="connect-details">
                    <div class="row g-2">
                        <div class="col-4">
                            <div class="p-3" id="connect-l">
                                <div class="connect">
                                    <a href="tel:+94112345678"><i class="fa-solid fa-phone"></i>011 234 5678</a>
                                </div>
                                <div class="command">Call Us 24/7</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3" id="connect-m">
                                <div class="connect">
                                    <a href="mailto:neclinic.care@gmail.com"><i
                                            class="fa-solid fa-envelope"></i>neclinic.care@gmail.com</a>
                                </div>
                                <div class="command">Mail Us 24/7</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3" id="connect-r">
                                <div class="connect">
                                    <a href="https://maps.app.goo.gl/SkcnLrY5RBm4waZz6" target="_blank"><i
                                            class="fa-solid fa-location-dot"></i>29 Almeida Road, Colombo 07</a>
                                </div>
                                <div class="command">Our Location</div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>

        <div class="col-6">
            <div class="p-3" id="image-container">
                <img src="/national-e-clinic-portal/images/support/contact-us.png" alt="contact-us">
            </div>
        </div>

        <div class="col-12">
            <h1 id="support-main-title">We are here for you!</h1>
            <p id="support-main-content">For any queries or information regarding our services or for booking an
                advanced consultation, feel free to fill out this convenient form or drop us an email.</p>
            <div class="p-3" id="request-submission">
                <div id="support-title">
                    <h2>Submit a Request</h2>
                </div>

                <div id="support-content">
                    <form class="request-form" action="submit_question.php" method="post">

                        <div class="form-field required">
                            <label for="email">Your email address</label>
                            <input type="email" name="email" id="email" required>
                            <div class="notification-error">Email: cannot be blank</div>
                        </div>

                        <div class="form-field required">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" id="subject" maxlength="150" size="150" required>
                            <div class="notification-error">Subject: cannot be blank</div>
                        </div>


                        <div class="form-field required">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" required></textarea>
                            <p class="hint">Please enter the details of your request. A member of our support staff will
                                respond
                                as
                                soon as possible.</p>
                            <div class="notification-error">Description: cannot be blank</div>
                        </div>

                        <div class="form-field">
                            <label for="question">Question</label>
                            <input type="text" name="question" id="question">
                            <p class="hint">Describe your issue in a few words. Do not include medical information.</p>
                        </div>


                        <div class="form-field">
                            <label for="attachments">Attachments</label>
                            <div class="upload-dropzone">
                                <input type="file" multiple id="attachments">
                                <span><a>Add file or drop files here</a></span>
                            </div>
                            <div id="upload-error" class="notification-error"></div>
                            <ul id="upload-pool"></ul>
                        </div>

                        <div class="form-field">
                            <button type="submit">Submit</button>
                        </div>

                    </form>



                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="p-3">
                <h1 id="map-title">Our Location</h1>
                <div id="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.6472989063304!2d79.86312417499717!3d6.932691118273018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae259cdb0f21c3d%3A0x582f1a05267cf2c5!2sMinistry%20of%20Health!5e0!3m2!1sen!2slk!4v1736414862571!5m2!1sen!2slk"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>

    </div>

</div>