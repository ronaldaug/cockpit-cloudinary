# cockpit-cloudinary
Cloudinary upload addon for cockpit cms

## Installation
- Add **cockpit-cloudinary** folder inside "addons" folder
- Make sure to rename the folder name as **cockpit-cloudinary**
- Edit **config.php** and add cloudinary api keys.
-----

## Request
- Route to request = "/api/cloudinary"

`Make sure to allow this request route when generating API token in backend`

### Upload example
```html
<form id="myForm">
  <input type="file">
  <button type="submit">Upload</button>
</form>
```
```javascript
const myInput = document.querySelector('input[type="file"]');
const myForm = document.querySelector('#myForm');

myForm.addEventListener("submit",e=>{
    e.preventDefault();
    let data = new FormData();
    data.append('file', myInput.files[0]) ;
    fetch('/api/cloudinary?token=cockpit-token-key', {
      method: 'POST',
      body: data
    }).then(e=>e.json()).then(res=>{
        console.log(res)
    })
})
```

----

### Delete example
```javascript
const data = new FormData();
const deleteId = ' '  // deleteId = public_id of image.
data.append('deleteId',deleteId) ;
fetch('/api/cloudinary?token=cockpit-token-key', {
    method: 'POST',
    body: data
}).then(e=>e.json()).then(res=>{
    console.log(res)
})
```

## Credit goes to
- Cockpit CMS
- Cloudinary


Author - Ronald Aug
