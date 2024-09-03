/**
 * Custom implementation for the FingerPrint
 * Reader and other JS functions
 * @authors Dahir Muhammad Dahir (dahirmuhammad3@gmail.com)
 * @date    2020-04-14 17:06:41
 * @version 1.0.0
 */

// let currentFormat = Fingerprint.SampleFormat.Raw;
// let currentFormat = Fingerprint.SampleFormat.Intermediate;
// let currentFormat = Fingerprint.SampleFormat.Compressed;
let currentFormat = Fingerprint.SampleFormat.PngImage;

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
// myReader.reader.startCapture();

function storeSample(sample){
    let samples = JSON.parse(sample.samples);
    console.log(sample, samples);
    // fp = samples[0].Data;
    fp = samples[0];

    Swal.fire({
        title: "Success",
        text: "Just a moment...",
        didOpen: () => {
            Swal.showLoading();
            myReader.reader.stopCapture();
        }
    });

    setTimeout(() => {
        $.ajax({
            url: 'https://verify.onehealthnetwork.com.ph/storeFp',
            type: 'POST',
            data: {
                code: code,
                fp: fp,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: result => {
                setTimeout(() => {
                    window.location.href = "https://verify.onehealthnetwork.com.ph/success2"
                }, 5000);
            }
        })
    }, 3000);
}

function showMessage(text){
    alert(text);
}