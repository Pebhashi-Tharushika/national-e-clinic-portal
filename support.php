<div id="support-container">

    <div id="support-title">
        <h1>Submit a Request</h1>
    </div>

    <div id="support-content">
        <form class="request-form" action="submit_question.php" method="post">

            <div class="form-field required">
                <label for="email">Your email address</label>
                <input type="email" name="email" id="email" required>
                <div class="notification-error">Email:  cannot be blank</div>
            </div>

            <div class="form-field required">
                <label for="subject">Subject</label>
                <input type="text" name="subject" id="subject" maxlength="150" size="150" required>
                <div class="notification-error">Subject:  cannot be blank</div>
            </div>


            <div class="form-field required">
                <label for="description">Description</label>
                <textarea name="description" id="description" required></textarea>
                <p class="hint">Please enter the details of your request. A member of our support staff will respond as
                    soon as possible.</p>
                    <div class="notification-error">Description:  cannot be blank</div>
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