/**
 * Custom implementation for the FingerPrint
 * Reader and other JS functions
 * @authors Dahir Muhammad Dahir (dahirmuhammad3@gmail.com)
 * @date    2020-04-14 17:06:41
 * @version 1.0.0
 */

// let currentFormat = Fingerprint.SampleFormat.Raw;
let currentFormat = Fingerprint.SampleFormat.Intermediate;
// let currentFormat = Fingerprint.SampleFormat.Compressed;
// let currentFormat = Fingerprint.SampleFormat.PngImage;

let FingerprintSdkTest = (function () {
    function FingerprintSdkTest() {
        this.sdk = new Fingerprint.WebApi;

        this.sdk.onSamplesAcquired = function (s) {
            // Sample acquired event triggers this function
            storeSample(s);
        };
    }

    // this is were finger print capture takes place
    FingerprintSdkTest.prototype.startCapture = function () {
        if (this.acquisitionStarted) // Monitoring if already started capturing
            return;
        let _instance = this;
        this.operationToRestart = this.startCapture;
        this.sdk.startAcquisition(currentFormat, "").then(function () {
            _instance.acquisitionStarted = true;
        }, function (error) {
            showMessage(error.message);
        });
    };
    
    FingerprintSdkTest.prototype.stopCapture = function () {
        if (!this.acquisitionStarted) //Monitor if already stopped capturing
            return;
        let _instance = this;
        this.sdk.stopAcquisition().then(function () {
            _instance.acquisitionStarted = false;
        }, function (error) {
            showMessage(error.message);
        });
    };
    
    return FingerprintSdkTest;
})();


class Reader{
    constructor(){
        this.reader = new FingerprintSdkTest();
    }
}

let myReader = new Reader();

function beginCapture(){
    myReader.reader.startCapture();
}

function storeSample(sample){
    console.log(sample);
    let samples = JSON.parse(sample.samples);
    console.log(samples);
    let sampleData = samples[0].Data;
    console.log(sampleData);
}

function serverEnroll(){
    if(!readyForEnroll()){
        return;
    }

    let data = myReader.currentHand.generateFullHand();
    let successMessage = "Enrollment Successful!";
    let failedMessage = "Enrollment Failed!";
    let payload = `data=${data}`;

    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function(){
        if(this.readyState === 4 && this.status === 200){
            if(this.responseText === "success"){
                showMessage(successMessage, "success");
            }
            else{
                showMessage(`${failedMessage} ${this.responseText}`);
            }
        }
    };

    console.log("this is where you send");

    // xhttp.open("POST", "/src/core/enroll.php", true);
    // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // xhttp.send(payload);
}

function showMessage(text){
    alert(text);
}