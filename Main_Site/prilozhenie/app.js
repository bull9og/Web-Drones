const express = require('../../node_modules/express');
const app = express();
const http = require('http').Server(app);
const io = require('../../node_modules/socket.io')(http);
const arDrone = require('../../node_modules/ar-drone');
const client = arDrone.createClient();
const NodeArDrone = require('../../node_modules/ar-drone-wifi-mjpeg');

// Устанавливаем соединение с дроном
client.takeoff();

app.use(express.static('public'));

const videoStream = new NodeArDrone.WifiMjpeg.Stream({
	client: client
});

app.get('../../node_modules/video', (req, res) => {
	res.writeHead(200, {'Content-Type': 'multipart/x-mixed-replace; boundary=--dab14da78bcb89b7a9b7da9bd76abadabd9ad9' });

	videoStream.connect().then(() => {
		videoStream.on('image', (image) => {
			res.write('--dab14da78bcb89b7a9b7da9bd76abadabd9ad9');
			res.write('Content-Type: image-jpegrn');
			res.write('Content-Length: ' + Buffer.byteLength(image) + 'rn');
			res.write('rn');
			res.write(image, 'binary');
			res.write('rnrn');
		});
	});
});

io.on('connection', function(socket) {
  console.log('Подключился новый клиент');

  socket.on('keydown', function(key) {
    switch (key) {
      case 'w':
        client.front(0.5);
        break;
      case 's':
        client.back(0.5);
        break;
      case 'a':
        client.left(0.5);
        break;
      case 'd':
        client.right(0.5);
        break;
      case 'z':
        client.land();
        break;
	  case 'r':
		client.up(0.5);
		break;
	  case 'f':
		client.down(0.5);
		break;
	  case 'q':
		client.clockwise(0.5);
		break;
	  case 'e':
		client.counterClockwise(0.5);
		break;
    }
  });

  socket.on('keyup', function() {
    client.stop();
  });

  socket.on('disconnect', function() {
    client.land();
    console.log('Клиент отключился');
  });
});

http.listen(3000, function() {
  console.log('Сервер запущен на порту 3000');
});