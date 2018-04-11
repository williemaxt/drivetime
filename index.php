@import url('https://fonts.googleapis.com/css?family=Nunito|Ubuntu');
@import url('https://fonts.googleapis.com/css?family=Megrim');
/*
red: #C11218
grey: #808080
black: #1c040c
font-family: 'Nunito', sans-serif;
font-family: 'Ubuntu', sans-serif;
*/



.burger-nav{
  display: block;
  height: 40px;
  width: 30px;
  float: right;
  cursor: pointer;
}
#burger div{
  width: 35px;
  height: 5px;
  background: #ffffff;
  margin: 5px;
}
#burger{
  float: right;
  margin: 10px;
  margin-right: 20px;
  visibility: hidden;
}



/*Classes for UI Elements*/
.button{
  border: 2px solid #ffffff;
  background: #eca217;
  color: #ffffff;
  height: 50px;
  width: 200px;
  border-radius: 3px;
  font-size: 2em;
}
.button:hover{
  background: #ffffff;
  color: #eca217;
}
.transparent-button{
  border: 2px solid #ffffff;
  background: transparent;
  color: #ffffff;
  height: 50px;
  width: 200px;
  border-radius: 3px;
  font-size: .5em;
  margin-bottom: 10px;
}
.transparent-button:hover{
  color: #eca217;
  background: #ffffff;
}
/*CSS for Web Pages*/
.wrapper{
  width: 80%;
  background: transparent;
  margin: 0px auto;
  margin-top: 10px;
}
#logoName{
  font-size: 2.5em;
  margin: 0;
}
body{
  margin: 0px;
  background: #ffffff;
}
header{
  background: #3896b2;
  min-height: 85px;
  font-weight: bold;
}
#logoName{
  font-family: 'Megrim', cursive;
  color: #ffffff;
}
nav{
  height: 100%;
}
nav ul{
  list-style: none;
  margin: 0px;
  width: 100%;
  padding: 0;
  height: 100%;
}
nav ul li{
  display: inline-block;
  padding: 32px;
  color: #ffffff;
  font-family: 'Ubuntu', sans-serif;
}
nav ul li:hover{
  border-bottom: 6px solid #ffffff;
  transition: .4s;
}
footer{
  background: #333333;
  margin: 0px auto;
  color: #ffffff;
}
footer ul{
  list-style: none;
  padding: 0;
  margin:0;
}
footer ul li{
  margin: 0;
  width: 30%;
  display: inline-block;
  padding-left: 1%;
  padding-right: 1%;
}
nav a {
  text-decoration: none;
  color: #ffffff;
}
#imgHome{
  background-image: url(../images/machine.jpg);
  background-size:cover;
  background-color: #000000; // Tint
  background-blend-mode: multiply;
}
.imgText h1{
  opacity: 1;
}
.imgHeader{
  height: 600px;
  text-align: center;
}
.imgHeader h1{
  margin: 0px;
  padding-top: 200px;
  font-size: 5em;
  font-family: 'Ubuntu', sans-serif;
  color: #ffffff;
}
.imgHeader p{
  font-size: 2.5em;
  color: #ffffff;
  font-family: 'Nunito', sans-serif;
}
.bar{
  width: 100%;
  min-height: 120px;
  background: #3896b2;
  margin: 0;
  font-family: 'Nunito', sans-serif;
}
.bar ul{
  list-style: none;
  margin: 0;
  text-align: center;
  font-size: 2em;
  padding-top: 20px;
  color: #ffffff;
}
.bar ul li{
  display: inline-block;
  margin-left: 40px;
  margin-right: 40px;
}
#homeBar ul li p{
  font-weight: bold;
}
#homeBar ul{
  padding: 0;
}
main{
  float: left;
  width: 70%;
  color: #808080;
  padding: 10px;
}
.iconUl{
  list-style: none;
  margin: 0px auto;
  padding: 0;
}
.iconUl li{
  width: 47%;
  display: inline-block;
  padding: 10px;
}
.iconUl li img{
  width: 70px;
  height: auto;
}
aside{
  float: right;
  width: 25%;
  color: #808080;
  padding: 10px;
}
.aside img{
  width: 100%;
  border-radius: 3px;
}
.aside input{
  width: 100%;
  height: 40px;
  margin-bottom: 10px;
  border-radius: 3px;
  border: none;
  background: #808080;
  font-size: 1.7em;
  color: #ffffff;
}
.aside textarea{
  margin: 0px auto;
  width: 99%;
  height: 80px;
  border-radius: 3px;
  border: none;
  background: #808080;
  font-size: 1.7em;
  color: #ffffff;
}
.aside button{
  width: 100%;
  border: none;
}

#secondBar{
  clear: both;
  background: #808080;
  font-family: 'Ubuntu', sans-serif;
  padding-top: 30px;
  padding-bottom: 50px;
}
#secondBar ul h1{
  font-size: 1em;
}
#secondBar p{
  font-size: .6em;
}
#secondBar ul{
  list-style: none;
  padding: 0;
}
#secondBar img{
  width: 100%;
}
#secondBar li{
  width: 20%;
  display: inline-block;
  font-size: 1em;
  background: #ffffff;
  padding: 10px;
  color: #808080;
  min-height: 500px;
  margin-top: 0px;
}
#secondBar section{
  width: 100%
}
.prompt{
  text-align: center;
  color: #808080;
  font-size: 2em;
  font-weight: bold;
  margin: 0;
}
#testimonies{
  width: 100%;
  margin: 0;
  padding: 0;
  padding-top: 20px;
}
#testimonies ul{
  list-style: none;
  margin:0px auto;
  width: 90%;
  padding: 0;
  padding-top: 40px;
}
#testimonies li{
  width: 20%;
  display: inline-block;
  text-align: center;
  color: #808080;
  padding-left: 6.5%;
  padding-right: 6.5%;
}
#testimonies img{
  width: 70px;
}
#imgHomeBottom{
  background-image: url(../images/top_down.jpg);
  margin-bottom: 0px;;
}
.footerBottom{
  text-align: center;
  margin: 0;
  padding: 8px;;
  color: #ffffff;
  background: #262626;
  margin-top: 10px;
}
#bottomLine{
  height: 15px;
  background: #3896b2;
  padding: 0;
  margin:0;
  margin-bottom: -10px;
}

@media screen and (max-width:1330px){
  main{
    float: none;
    width: 100%;
  }
  .iconUl{
  }
  .iconUl li{
    width: 47%;
  }
  .aside{
    float: none;
    width: 80%;
    margin: 0px auto;
  }
  #secondBar ul{
    display: block;
  }
  #secondBar ul li{
    width: 300px;
    margin-top: 15px;
  }

}



@media screen and (max-width:928px){
  #secondBar ul li{
    width: 80%;
    margin-top: 15px;
    margin: 0;
  }
  .iconUl li{
    width: 45%;
  }
}

@media screen and (max-width:770px){
  #burger{
    visibility: visible;
  }
  nav ul{
    list-style: none;
    overflow: hidden;
    height: 0;
    margin: 0px auto;
    width: 100%;
    transition: 1s;
  }
  nav ul.open{
    height: auto;
    margin: 0px auto;
    padding-top: 40px;
    transition: 1s;
  }

  #secondBar ul li{
    width: 90%;
    margin-top: 15px;
    margin-bottom: 10px;
    margin: 0;
  }
  .iconUl li{
    width: 300px;
  }
  #reviews li{
    display: inline;
    width: 300px;
    margin: 0px auto;
  }
  #reviews li img{
    margin: 0px auto;
    width: 200px;
  }
}
@media screen and (max-width:605px){

}
@media screen and (max-width:400px){
  .imgHeader h1{
    margin: 0px;
    padding-top: 100px;
    font-size: 3em;
  }
  .imgHeader p {
    font-size: 2em;
    color: #ffffff;
    font-family: 'Nunito', sans-serif;
  }
}
