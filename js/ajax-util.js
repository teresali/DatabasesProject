function ajax(urlstring, action, params, callback) {
  $.ajax({
    url: urlstring,
    type: 'POST',
    data: {'action': action, 'params': params},
    success: function(data, status) {
      callback({'data': data, 'status' : status});
    },
    error: function(xhr, desc, err) {
      callback({'xhr': xhr, 'status': desc, 'error': err});
    }
  });
}
