/*Partie conditions générale // form de connexion*/
$(function() {
  $('#last').click(function() {
    let pre = document.createElement('pre');
    pre.style.maxHeight = "400px";
    pre.style.margin = "0";
    pre.style.padding = "24px";
    pre.style.whiteSpace = "pre-wrap";
    pre.style.textAlign = "justify";
    pre.appendChild(document.createTextNode($('#la').text()));
    alertify.confirm(pre, function() {
      alertify.success('Merci bien');
    }, function() {
      alertify.success('Merci bien');
    }).set({
      labels: {
        ok: 'J\'accepte',
        cancel: 'J\'accepte'
      },
      padding: false
    });
  });

  $('#log').click(function() {
    $('#loginForm').css("visibility", "visible");
    alertify.genericDialog || alertify.dialog('genericDialog', function() {
      return {
        main: function(content) {
          this.setContent(content);
        },
        setup: function() {
          return {
            focus: {
              element: function() {
                return this.elements.body.querySelector(this.get('selector'));
              },
              select: true
            },
            options: {
              title: "Connexion",
              basic: true,
              maximizable: false,
              resizable: true,
              overflow: false,
              padding: true
            }
          };
        },
        settings: {
          selector: "undefined"
        }
      };
    });
    //force focusing password box
    alertify.genericDialog($('#loginForm')[0]).set('selector', 'input[type="password"]');
    $('.ajs-body').css("height", "300px");
    $('.ajs-dialog').css("background-image", "url('../image/conn.jpg')");
  });
});
