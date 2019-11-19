$(document).ready(function(){

   //*****************************************************************
   hideText = '<input id="uniqueLink" type="text" value="' + document.URL + '">';
   $("#link").html(hideText);

   /*****************************************************************
   *
   */
   $("#copyLink").click(function() {
      copyText = document.getElementById("uniqueLink");
      $("#link").css('display','block');
      copyText.select();
      document.execCommand("copy");
      $("#link").css('display','none');

      alert("Copied the link: " + copyText.value);
   });

   /*****************************************************************
   *
   */
   $("#generateNewLink").click(function() {
      $.ajax({
         type: "GET",
         url: "/generate-new",
         data: "",
         sync: false,
         success: function(data){
            data = JSON.parse(data);
            window.location.href = "/" + data;
         }
      });
   });

    /*****************************************************************
   *
   */
   $("#deactivateLink").click(function() {
      $.ajax({
         type: "GET",
         url: "/deactivate",
         data: "",
         sync: false,
         success: function(data){
            data = JSON.parse(data);
            if (data == 'deactivated') {
               alert("Your link daectivated");
               location.href = '/';
            }

         }
      });
   });

   /*****************************************************************
   *
   */
   $("#imFeelingLucky").click(function() {
      $.ajax({
         type: "GET",
         url: "/feeling-lucky",
         data: "",
         sync: false,
         success: function(data){
            data = JSON.parse(data);
            if (data.win_lose == 'Lose') {
               $("#feeling-lucky").html('<p>Random number: ' + data.random_num + '</p><p>Lose</p>');
            } else {
               $("#feeling-lucky").html('<p>Random number: ' + data.random_num + '<p>Win</p><p>Your prise: ' + data.win_lose + '</p>');
            }
         }
      });
   });

   /*****************************************************************
   *
   */
   $("#history").click(function() {
      $.ajax({
         type: "GET",
         url: "/history",
         data: "",
         sync: false,
         success: function(data){
            data = JSON.parse(data);
            if (data[0] != 0) {
               historyText = '';
               data.forEach(function(item, i, arr) {
                  historyText += '<p>' + i + '. Random number: ' + item.random_num;
                  if (item.win_lose == 'Lose') {
                     historyText += '. Lose</p>';
                  } else {
                     historyText += '. Win. Your prise: ' + item.win_lose + '</p>';
                  }
               });
               $("#history-text").html(historyText);
            } else {
               $("#history-text").html('There is no history data yet');
            }
         }
      });
   });

   /*****************************************************************
   *
   */
   $(".delete-user").click(function() {
      userId = this.id.substr(12);

      $.ajax({
         type: "POST",
         url: "/delete",
         data: {'userId': userId},
         sync: false,
         success: function(data){
            data = JSON.parse(data);
            alert (data);
            location.href = '/adminpanel';
         }
      });
   });

})