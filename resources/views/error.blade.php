<div class="container">

  <div class="thank-you">
    
    <img src="{{ asset("images/shdmc.png") }}" width="500" height="300" alt="IMG">
    
    <h1>Sorry!</h1>
    
    <p>Their has been a problem in your verification.</p>

    <p>Please try again or contact admin if error persists.</p>

    <p>You will be automatically redirected in 5 seconds</p>
    
  </div>
  
</div>

<style>
  body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
/*    background: black;*/
/*    color: white;*/
    font-family: 'Roboto', sans-serif;
  }

  .thank-you {
    text-align: center;
    
    img {
      max-width: 300px;
    }
    
    p {
      font-size: 16px;
    }
    
    .signature {
      max-width: 150px;
    }
  }
</style>

<script>
  setTimeout(() => {
    window.location.href = "https://verify.onehealthnetwork.com.ph/";
  }, 5000);
</script>