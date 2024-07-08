function addData() {
    // Get input values
    let nama = document.getElementById("namaInput").value;
    let alamat = document.getElementById("alamatInput").value;
    let tanggal = document.getElementById("tanggalInput").value;
    let durasi = document.getElementById("durasiInput").value;
    let selesaiBerlangganan = document.getElementById(
        "selesaiBerlangganan"
    ).value;

    // Get the table and insert a new row at the end
    let table = document.getElementById("outputTable");
    let newRow = table.insertRow(table.rows.length);

    // Insert data into cells of the new row
    newRow.insertCell(0).innerHTML = nama;
    newRow.insertCell(1).innerHTML = alamat;
    newRow.insertCell(2).innerHTML = tanggal;
    newRow.insertCell(3).innerHTML = durasi;
    newRow.insertCell(4).innerHTML = selesaiBerlangganan;
    newRow.insertCell(5).innerHTML =
        '<button onclick="editData(this)">Edit</button>' +
        '<button onclick="deleteData(this)">Delete</button>';

    // Clear input fields
    clearInputs();
    
    document.getElementById("formContainer").style.display = "none";
    document.getElementById("outputTable").style.display = "block";
    document.getElementById("h1-ouputTable").style.display = "block";
    document.getElementById("tampilEditIBBtn").style.display = "block";
    document.getElementById("addDataBtn").style.display = "none";
}

function editData() {
    // Get the parent row of the clicked button
    let row = editDataOpen().value;

    // Get the cells within the row
    let namaCell = row.cells[0];
    let alamatCell = row.cells[1];
    let tanggalCell = row.cells[2];
    let durasiCell = row.cells[3];
    let selesaiBerlanggananCell = row.cells[4];

    // Prompt the user to enter updated values
    let namaInput = document.getElementById("namaInput").value;
    let alamatInput = document.getElementById("alamatInput").value;
    let tanggalInput = document.getElementById("tanggalInput").value;
    let durasiInput = document.getElementById("durasiInput").value;
    let selesaiBerlanggananInput = document.getElementById(
        "selesaiBerlangganan"
    ).value;

    // Update the cell contents with the new values
    namaCell.innerHTML = namaInput;
    alamatCell.innerHTML = alamatInput;
    tanggalCell.innerHTML = tanggalInput;
    durasiCell.innerHTML = durasiInput;
    selesaiBerlanggananCell.innerHTML = selesaiBerlanggananInput;


    clearInputs();
    document.getElementById("formContainer").style.display = "none";
    document.getElementById("outputTable").style.display = "block";
    document.getElementById("h1-ouputTable").style.display = "block";
    document.getElementById("tampilEditIBBtn").style.display = "block";
    document.getElementById("editDataOpen").style.display = "none";
}

function deleteData(button) {
    // Get the parent row of the clicked button
    let row = button.parentNode.parentNode;

    // Remove the row from the table
    row.parentNode.removeChild(row);
}

function clearInputs() {
    // Clear input fields
    document.getElementById("namaInput").value = "";
    document.getElementById("alamatInput").value = "";
    document.getElementById("tanggalInput").value = "";
    document.getElementById("durasiInput").value = "";
    document.getElementById("selesaiBerlangganan").value = "";
}


function tampilEditIB() {
    document.getElementById("formContainer").style.display = "block";
    document.getElementById("outputTable").style.display = "none";
    document.getElementById("h1-ouputTable").style.display = "none";
    document.getElementById("tampilEditIBBtn").style.display = "none";
    document.getElementById("addDataBtn").style.display = "block";
}

function editDataOpen(button) {
    let row = button.parentNode.parentNode;
    document.getElementById("formContainer").style.display = "block";
    document.getElementById("outputTable").style.display = "none";
    document.getElementById("h1-ouputTable").style.display = "none";
    document.getElementById("tampilEditIBBtn").style.display = "none";
    document.getElementById("editDataBtn").style.display = "block";
    document.getElementById('submit-type').name = "update-subscriber";
    
    // element for update form's values
    let nama = document.getElementById(`nama-${button.name}`);
    let alamat = document.getElementById(`alamat-${button.name}`);
    let kab = document.getElementById(`kab-${button.name}`);
    let regist = document.getElementById(`regist-${button.name}`);
    let durasi = document.getElementById(`durasi-${button.name}`);
    let selesai = document.getElementById(`selesai-${button.name}`);

    // update form values
    document.getElementById('hidden-id').value = button.name;
    document.getElementById('namaInput').value = nama.innerHTML;
    document.getElementById('alamatInput').value = alamat.innerHTML;
    document.getElementById('kabInput').value = kab.innerHTML;
    document.getElementById('kabInput').innerHTML = kab.innerHTML;
    document.getElementById('tanggalInput').value = regist.innerHTML;
    document.getElementById('durasiInput').value = durasi.innerHTML;
    document.getElementById('selesaiBerlangganan').value = selesai.innerHTML;
    return row;
}

const dropArea = document.getElementById("drop-area");
            const inputFile = document.getElementById("input-file");
            const imgView = document.getElementById("img-view");
            const profilePicture = document.getElementById("profile-p");
            const profilePictureC = document.getElementById("profile-p-container");

            inputFile.addEventListener("change", uploadImage);

            function uploadImage() {
                let imgLink = URL.createObjectURL(inputFile.files[0]);
                imgView.style.backgroundImage = `url(${imgLink})`;
                profilePicture.src = URL.createObjectURL(inputFile.files[0]);


                profilePicture.textContent = "";
                imgView.textContent = "";
                imgView.style.border = 0;
            }

            dropArea.addEventListener("dragover", function (e) {
                e.preventDefault();
            });
            dropArea.addEventListener("drop", function (e) {
                e.preventDefault();
                inputFile.files = e.dataTransfer.files;
                uploadImage();
            });