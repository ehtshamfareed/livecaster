
function ValidateSize(file) {
        var FileSize = file.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 1) {
            alert('File size exceeds 1 MB');
            file.value = "";
            return false;
           // $(file).val(''); //for clearing with Jquery
        } else {
            return true;
        }
    }
