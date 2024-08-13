<html>
  <head>
    <title>Biometrics</title>

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
  </head>

  <body>
    <div class="container">

      <div class="thank-you">
        
        <img src="{{ asset("images/fp.jpg") }}" width="500" height="300" alt="IMG">
        
        <h1>Please Scan Your Fingerprint</h1>
        
        <p id="msg1" style="display: none;">Success</p>

        <p id="msg2" style="display: none;">You will be automatically redirected in 5 seconds</p>
        
      </div>
      
    </div>

    <script>
      var fp = null;
    </script>

    <script src="js/es6-shim.js"></script>
    <script src="js/websdk.client.bundle.min.js"></script>
    <script src="js/fingerprint.sdk.min.js"></script>
    <script src="js/custom2.js"></script>
  </body>
</html>