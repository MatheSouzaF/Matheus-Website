import * as jQuery from 'jquery';
import { main } from "./home.js";
import * as cursor from "./cursor.js";

jQuery(() => {
   main();
   // Agora você pode acessar as exportações de cursor.js usando o objeto 'cursor'
   cursor.someFunction(); // Substitua 'someFunction' pela função ou variável desejada de cursor.js
});
