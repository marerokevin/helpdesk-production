

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  
</head>
<body>
<h2>Upload Screenshot</h2>
<form action="upload.php" method="post" enctype="multipart/form-data">
		<label for="screenshot">Screenshot:</label>
        <img id="preview" name="" />
        <input type="text" name="link" id="link">

        <input type="submit"  name="Upload" >
	</form>


    <script>
document.addEventListener('paste', function (evt) {
    // Get the data of clipboard
    const clipboardItems = evt.clipboardData.items;
    const items = [].slice.call(clipboardItems).filter(function (item) {
        // Filter the image items only
        return item.type.indexOf('image') !== -1;
    });
    if (items.length === 0) {
        return;
    }

    const item = items[0];
    // Get the blob of image
    const blob = item.getAsFile();
    console.log(blob)

    const imageEle = document.getElementById('preview');
    imageEle.src = URL.createObjectURL(blob);
document.getElementById('link').value=imageEle.src


});

// Get the form element
const form = document.querySelector('form');

// Add event listener to the form submit event
form.addEventListener('submit', function (event) {
   // Get the blob URL
const blobUrl = document.getElementById('link').value;

// Create a new XMLHttpRequest object
const xhr = new XMLHttpRequest();

// Open a new POST request
xhr.open('POST', '/upload');

// Create a new FormData object
const formData = new FormData();

// Convert the blob URL to a binary file
fetch(blobUrl)
  .then(res => res.blob())
  .then(blob => {
    // Append the binary file to the FormData object
    formData.append('image', blob, 'image.jpeg');

    // Send the FormData object to the server
    xhr.send(formData);
  });

});






    </script>
</body>
</html>