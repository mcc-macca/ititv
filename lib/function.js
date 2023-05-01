/**
 * MACCA COMPUTER NEWS SYSTEM - ITITV
 * SCRIPT PER L'AGGIORNAMENTO DELL'ORA NEL NEWS.PHP VERSIONE TV
 * APGL 3. (C) 2018 - 2023
 */

function updateClock() {
  var clock = document.getElementById("clock");
  var date = new Date();

  var hours = date.getHours();
  var minutes = date.getMinutes();

  if (hours < 10) hours = "0" + hours;
  if (minutes < 10) minutes = "0" + minutes;

  clock.innerHTML = hours + ":" + minutes;
}

setInterval(updateClock, 1000);

var currentTime = new Date();
var currentHour = currentTime.getHours();
var currentMinute = currentTime.getMinutes();

var openingHours = ["08:10", "11:45"];
var closingHours = ["09:10", "13:10"];

var openingMinutes = [];
var closingMinutes = [];

for (var i = 0; i < openingHours.length; i++) {
  var openingTime = openingHours[i].split(":");
  var openingHour = parseInt(openingTime[0]);
  var openingMinute = parseInt(openingTime[1]);
  var openingTotalMinutes = openingHour * 60 + openingMinute;
  openingMinutes.push(openingTotalMinutes);

  var closingTime = closingHours[i].split(":");
  var closingHour = parseInt(closingTime[0]);
  var closingMinute = parseInt(closingTime[1]);
  var closingTotalMinutes = closingHour * 60 + closingMinute;
  closingMinutes.push(closingTotalMinutes);
}

var isOpen = false;

for (var i = 0; i < openingMinutes.length; i++) {
  if (currentHour > openingHours[i] && currentHour < closingHours[i]) {
    isOpen = true;
    break;
  } else if (
    currentHour == openingHours[i] &&
    currentMinute >= openingMinutes[i]
  ) {
    isOpen = true;
    break;
  } else if (
    currentHour == closingHours[i] &&
    currentMinute <= closingMinutes[i]
  ) {
    isOpen = true;
    break;
  }
}

if (isOpen) {
  document.getElementById("orario").innerHTML = "APERTA";
  document.getElementById("orario").style.color = "green";
} else {
  document.getElementById("orario").innerHTML = "CHIUSA";
  document.getElementById("orario").style.color = "red";
}