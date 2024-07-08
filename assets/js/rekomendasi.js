const rekomendasiBtn = document.getElementById('rekomendasiBtn');
const rekomendasiDarahContainer = document.getElementById('rekomendasiDarahContainer');
const list_tipe = []; const list_unit = [];

for(let i = 0; i<5; i++){
    list_tipe.push(document.getElementById(`code-${i}`).innerHTML);
    list_unit.push(document.getElementById(`total-${i}`).innerHTML);
}

rekomendasiBtn.addEventListener('click', () => {
    const bloodRecommendations = [
        { type: list_tipe[0], units: list_unit[0] },
        { type: list_tipe[1], units: list_unit[1] },
        { type: list_tipe[2], units: list_unit[2] },
        { type: list_tipe[3], units: list_unit[3] },
        { type: list_tipe[4], units: list_unit[4] }
    ];

    rekomendasiDarahContainer.innerHTML = '';
    bloodRecommendations.forEach(blood => {
        const bloodItem = document.createElement("div");
        bloodItem.classList.add("blood-item");
        bloodItem.innerHTML = `<span>${blood.type}</span> <span>${blood.units} Units</span>`;
        rekomendasiDarahContainer.appendChild(bloodItem);
    });
});


const filePath = '../../assets/requests-api/request.json';
function loadFileAsBlob(filePath) {
  return fetch(filePath)
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.blob();
    })
    .then(blob => {
      console.log('File disimpan sebagai Blob:', blob);
      return blob;
    })
    .catch(error => {
      console.error('Error saat membaca file:', error);
    });
}

// Menggunakan fungsi
let fileBlob;
loadFileAsBlob(filePath)
  .then(blob => {
    fileBlob = blob;
    return fileBlob;
  });

  function loadFileAsText(filePath) {
    return fetch(filePath)
      .then(response => {
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.text();
      })
      .then(text => {
        console.log('File disimpan sebagai text:', text);
        return text;
      })
      .catch(error => {
        console.error('Error saat membaca file:', error);
      });
  }
  
  let fileContent;
  loadFileAsText(filePath)
    .then(text => {
      fileContent = text;
      console.log('File berhasil dimuat sebagai text');
    });


const url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=AIzaSyAVPuoNxG9azyb8TyWd0_mDaqljb0yAeq0';
async function loadAndSendFile() {
  try {
    const response = await fetch(filePath);
    if (!response.ok) {
      throw new Error(`Gagal membaca file: ${response.status} ${response.statusText}`);
    }

    const fileContent = await response.text();
    const postResponse = await fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: fileContent,
    });

    if (!postResponse.ok) {
      throw new Error(`Gagal mengirim POST request: ${postResponse.status} ${postResponse.statusText}`);
    }

    const result = await postResponse.json();
    console.log('POST request berhasil:', result);
    return result;
  } catch (error) {
    console.error('Terjadi kesalahan:', error.message);
  }
}
