//import 'include-media/dist/_include-media.scss'; // from https://eduardoboucas.github.io/include-media/
import './app.scss';
import $ from 'jquery';

new Promise((resolve) => {
  console.log('waiting...');
  setTimeout(() => {
    $('#loading-indicator').remove();
    resolve();
  }, 5000);
});
