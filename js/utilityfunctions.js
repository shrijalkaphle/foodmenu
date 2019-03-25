function sendAjaxRequest(requestData){
    $.ajax({
      url: requestData.url ,
      type: requestData.method ,
      data: jsonStringifyObject(requestData.data) ,
    success: function (response) {
      return response;
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
    }
    });
}

function jsonStringifyObject(data){
    return JSON.stringify(data);
}