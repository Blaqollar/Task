<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV Import</title>
</head>
<body>

    <div id="app">
        <form @submit.prevent="submitForm">
            <input type="file" ref="fileInput" @change="handleFileChange" accept=".csv, .txt">
            <button type="submit" :disabled="!file">Import CSV</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                file: null,
            },
            methods: {
                handleFileChange(event) {
                    // Update the file data when the user selects a file
                    this.file = event.target.files[0];
                },
                submitForm() {
                    // Use FormData to append the file to the form data
                    let formData = new FormData();
                    formData.append('csv_file', this.file);

                    // Use fetch or your preferred AJAX library to submit the form data
                    fetch('{{ route('csv.import') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        // Handle the response as needed
                    })
                    .catch(error => console.error(error));
                },
            },
        });
    </script>

</body>
</html>
