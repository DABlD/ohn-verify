
<div class="container">

  <div class="thank-you">
    
    <img src="{{ asset("images/shdmc.png") }}" width="500" height="300" alt="IMG">
    
    <h1>Thank you!</h1>
    
    <p>Your ID has been successfully verified</p>

    <p>Please proceed with the biometrics</p>
    
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