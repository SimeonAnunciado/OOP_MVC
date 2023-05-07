<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h1 class="mt-5 text-center">
                <?php echo $title; ?>
            </h1>

            <form class="mt-5" action="index.php" method="POST">
                <input type="hidden" name="section" value="contact">
                <input type="hidden" name="action" value="submitContactForm">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleFormControlInput1"  placeholder="name@example.com">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Comment</label>
                    <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <button type="submit" name="email" class="btn btn-primary btn-block">Submit</button>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>