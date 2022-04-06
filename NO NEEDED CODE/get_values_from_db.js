$(document).ready(function(){
  $.ajax({
    url: "http://localhost/AgroSmartMonitor/data_db/data.php",
    method: "GET",
    success: function(data) {
      console.log(data);
      
      var Air_humidity = [];
      var Temp_air = []; 
      var Moisture_grd = [];
      var Temp_grd_50 = [];
      var Temp_grd_100 = [];
      var Leaf = [];
      var PhotoSensor = [];
      var Time = [];
      

      for(var i in data) {
        Time.push(data[i].V_Timestamp);
        Air_humidity.push(data[i].HUMIDITY_AIR);
        Temp_air.push(data[i].TEMPERATURE_AIR);
        Moisture_grd.push(data[i].MOISTURE_GRD);
        Temp_grd_50.push(data[i].TEMPERATURE_GRD_50CM);
        Temp_grd_100.push(data[i].TEMPERATURE_GRD_100CM);
        Leaf.push(data[i].LEAF_WEATNESS);
        PhotoSensor.push(data[i].PHOTOSENSOR);
        
      }

      var chartdata = {
        labels: Time,
        datasets : [
          {
            label: 'Air_humidity' ,
           // backgroundColor: 'rgba(20, 20, 100, 0.75)',
            borderColor: 'rgba(20, 20, 100, 0.75)',
            hoverBackgroundColor: 'rgba(20, 20, 100, 0.75)',
            hoverBorderColor: 'rgba(20, 20, 100, 0.75)',
            fill: false,
            data: Air_humidity
          },{
            label:  'Temp_air',
            //backgroundColor: 'rgba(200, 200, 200, 0.75)',
            borderColor: 'rgba(100, 230, 70, 0.75)',
            hoverBackgroundColor: 'rgba(100, 230, 70, 0.75)',
            hoverBorderColor: 'rgba(100, 230, 70, 0.75)',
            fill: false,
            data: Temp_air
          }, {
            label: 'Moisture_grd',
            //backgroundColor: 'rgba(200, 200, 200, 0.75)',
            borderColor: 'rgba(20, 100, 90, 0.75)',
            hoverBackgroundColor: 'rgba(20, 100, 90, 0.75)',
            hoverBorderColor: 'rgba(20, 100, 90, 0.75)',
            fill: false,
            data: Moisture_grd
          }, {
            label: 'Temp_grd_50',
            //backgroundColor: 'rgba(200, 200, 200, 0.75)',
            borderColor: 'rgba(36, 218, 212, 0.75)',
            hoverBackgroundColor: 'rgba(36, 218, 212, 0.75)',
            hoverBorderColor: 'rgba(36, 218, 212, 0.75)',
            fill: false,
            data: Temp_grd_50
          }, {
            label: 'Temp_grd_100',
           // backgroundColor: 'rgb(255,0,0)',
            borderColor: 'rgb(255,0,0)',
            hoverBackgroundColor: 'rgb(255,0,0)',
            hoverBorderColor: 'rgb(255,0,0)',
            fill: false,
            data: Temp_grd_100
          },{
            label: 'Leaf',
            //backgroundColor: 'rgba(0,0,255, 0.75)',
            borderColor: 'rgba(0,0,255, 0.75)',
            hoverBackgroundColor: 'rgba(0,0,255, 1)',
            hoverBorderColor: 'rgba(0,0,255, 1)',
            fill: false,
            data: Leaf,
          },{
            label: 'PhotoSensor',
            //backgroundColor: 'rgba(200, 200, 200, 0.75)',
            borderColor: 'rgba(200, 200, 200, 0.75)',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            fill: false,
            data: PhotoSensor
          }
        ]
      };

      var ctx = $("#mycanvas");

      var barGraph = new Chart(ctx, {
        type: 'line',
        data: chartdata
      });
    },
    error: function(data) {
      console.log(data);
    }
  });
});