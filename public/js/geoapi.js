function callGeoApi()
{
    fetch('https://geoapi.heartrails.com/api/json?method=getTowns&city=新宿') //（1）
  .then((response) => response.json()) //（2）
  .then((res) => {
                    

                     // (3)　通信が成功した場合の実行したい処理を記述する
                     console.log(res.response.location);
                     getApiSetTowns(res);

                  }) 

  .catch(error => {
                                //(5)
                            alert("実行失敗");　
                            alert(error);
                        })
                    
}