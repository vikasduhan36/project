<?php
require_once 'phpInclude/header.php';
?>



                <form id="register" action="handler.php" method="POST">
                    <h5>Creat an account</h5>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="tag name" name="tag"/>
                        <i class="fa fa-user icons"></i>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="short_name" name="short_name" id="email_address"/>
                        <i class="fa fa-envelope-o icons"></i>
                    </div>
                    
                    <div class="form-group">
                    <input type="hidden" name="action" value="tags"/>
                        <input type="submit" value="Register Now!" class="signin_btn registerbtn" id="save"/>
                    </div>
                    
                </form>
            
</body>
</html>
