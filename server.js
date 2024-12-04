//Criar o APP Express
const express = require("express");
const app = express();

app.get("/", function(request, response){
  response.sendFile(__dirname + "/index.html");
});