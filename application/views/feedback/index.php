<div class="container">
  <h2>Feedback form</h2>
  <p>Please send us your feedback/comments</p>
  
      
           <?php
          
           
     echo  "<form action=". base_url()."feedback/sendfeedback method='post'>";
          
?>
      
    <div class="form-group">
      <label for="comment">Comment:</label>
      <textarea name="comments" class="form-control" rows="5" id="comment"></textarea>
      <br/>
        <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Send</button>
    </div>
  </form>