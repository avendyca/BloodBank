const xValues = [];
const yValues = [];

for(i=1; i<6; i++){
  if(document.getElementById(`kab-${i}`) == null) break
  xValues.push(document.getElementById(`kab-${i}`).innerHTML);
  yValues.push(document.getElementById(`jumlah-${i}`).innerHTML);
}

// const xValues = ["Bantul", "Gunung Kidul", "Kulon Progo", "Selam", "Yogyakarta"];
// const yValues = [55, 49, 44, 24, 15];
const barColors = ["pink", "cyan","pink","cyan","pink"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Jumlah rumah sakit yang berlangganan di provinsi Yogyakarta"
    }
  }
});



function editProfileOpen(){
    document.getElementById("editProfilePopUp").style.display = "flex";
    document.getElementById("editProfile").style.display = "none";
}

