<?php
 require_once "../Connection/Connection.php";

class Kernel {
    private $preQueryCreate = 'CREATE Table if NOT exists students (
    isikucod int PRIMARY key not null,
    surname VARCHAR(30) not null,
    fname VARCHAR(30) not null,
    grade int not null,
    email VARCHAR(20) not null,
    message VARCHAR(255)
    )' ;

    private $preInsert = '
    INSERT INTO `students` (`isikucod`,`surname`,`fname`,`grade`,`email`,`message`)
    VALUES
      (160011976402,"Case","Denise",1,"a.auctor.non@yahoo.com","vitae, posuere at, velit. Cras lorem lorem, luctus"),
      (932554346979,"Small","Odysseus",4,"aenean@google.ca","lectus sit amet"),
      (621331893330,"Logan","Lunea",4,"tristique.senectus.et@yahoo.com","Suspendisse sed dolor. Fusce"),
      (666662684678,"Duncan","Martina",2,"hendrerit.id@outlook.org","tincidunt orci"),
      (342265460697,"Rodgers","Doris",1,"aliquam@outlook.com","lobortis, nisi"),
      (857940855798,"Morales","Ayanna",3,"donec.luctus.aliquet@google.couk","non massa non ante bibendum ullamcorper. Duis"),
      (888627484851,"Erickson","MacKenzie",1,"congue.in.scelerisque@icloud.couk","lectus. Nullam suscipit,"),
      (423153706782,"Mills","Celeste",2,"in@icloud.org","nibh. Donec est mauris, rhoncus id, mollis nec, cursus"),
      (475251228238,"Baxter","Jonah",4,"placerat.cras@google.net","Lorem"),
      (351865042037,"Hardy","Magee",2,"cras@hotmail.com","Fusce aliquam, enim nec tempus scelerisque,");
    INSERT INTO `students` (`isikucod`,`surname`,`fname`,`grade`,`email`,`message`)
    VALUES
      (823703133353,"Hardy","Astra",4,"quisque.ornare@hotmail.ca","amet lorem semper auctor. Mauris vel turpis. Aliquam adipiscing lobortis"),
      (770445785077,"Kim","Kieran",2,"eu.dolor@hotmail.ca","sit amet nulla. Donec non justo. Proin non massa"),
      (497821917591,"Dyer","Yardley",2,"vestibulum.accumsan@hotmail.edu","elementum,"),
      (370505271764,"Zimmerman","Nehru",3,"id@yahoo.couk","Sed congue,"),
      (214386336925,"Combs","Quinlan",2,"nunc.sed.pede@yahoo.com","lacinia at, iaculis"),
      (35078225377,"Wallace","Quintessa",2,"eleifend.vitae@outlook.couk","Donec est. Nunc ullamcorper, velit in"),
      (123763113285,"Hansen","Abra",5,"cum.sociis.natoque@hotmail.org","luctus lobortis. Class aptent taciti"),
      (821573402432,"Long","Lacy",3,"vulputate.eu@outlook.edu","adipiscing lacus. Ut nec urna et arcu imperdiet"),
      (470231516525,"Sims","Belle",2,"et@icloud.org","mauris eu elit. Nulla facilisi. Sed"),
      (305508386262,"Chan","Illiana",3,"adipiscing@google.com","Phasellus libero mauris, aliquam eu, accumsan sed, facilisis vitae,");
    INSERT INTO `students` (`isikucod`,`surname`,`fname`,`grade`,`email`,`message`)
    VALUES
      (241518244543,"Estrada","Edan",3,"felis.nulla@google.net","erat. Etiam vestibulum massa rutrum magna."),
      (349835407416,"White","Fritz",2,"proin.nisl@aol.couk","vitae purus gravida sagittis. Duis gravida. Praesent"),
      (407912142591,"Frazier","Mia",2,"phasellus@yahoo.net","amet"),
      (518347347943,"Santana","Cameran",4,"eros.nec.tellus@aol.com","laoreet ipsum. Curabitur consequat, lectus sit amet luctus vulputate, nisi"),
      (104648014139,"Farley","August",4,"elementum.lorem.ut@hotmail.edu","in consequat enim diam vel arcu. Curabitur ut odio"),
      (160321112457,"Nash","Rigel",2,"cras.vulputate@google.net","in faucibus orci luctus"),
      (197900086314,"Trujillo","Vladimir",3,"facilisis.magna@protonmail.net","malesuada fames ac turpis egestas. Aliquam fringilla cursus"),
      (250402451859,"Galloway","Lisandra",3,"elit@icloud.edu","accumsan laoreet ipsum. Curabitur consequat, lectus sit"),
      (1159166215,"Wooten","Rhonda",2,"ut.mi@yahoo.couk","magna, malesuada vel, convallis in,"),
      (761261527911,"Schroeder","Flynn",3,"ante.nunc.mauris@yahoo.edu","fermentum risus, at fringilla purus mauris");
    INSERT INTO `students` (`isikucod`,`surname`,`fname`,`grade`,`email`,`message`)
    VALUES
      (858814289619,"White","Constance",3,"lectus.justo.eu@outlook.ca","Integer eu lacus. Quisque imperdiet, erat nonummy ultricies"),
      (231656852812,"Dyer","Orson",1,"eu.sem@aol.net","sociis natoque penatibus et magnis dis"),
      (143900063647,"Harding","Shoshana",4,"a.ultricies@protonmail.com","ac arcu. Nunc"),
      (288179378673,"Henderson","Abra",5,"sed@outlook.ca","convallis ligula. Donec luctus"),
      (928078088968,"Campos","Clare",2,"orci.phasellus.dapibus@hotmail.couk","et, commodo at, libero. Morbi accumsan"),
      (563023350585,"Solis","Bell",3,"praesent.eu.dui@icloud.edu","lectus, a sollicitudin orci sem eget massa. Suspendisse eleifend."),
      (811875919362,"Aguirre","Elton",1,"tincidunt.nunc@icloud.org","accumsan convallis, ante lectus convallis est,"),
      (918621685311,"Pennington","Germaine",1,"ipsum@outlook.edu","Nulla eu neque"),
      (433149406612,"Ryan","Larissa",3,"porttitor@google.com","ac risus. Morbi metus. Vivamus euismod urna. Nullam lobortis quam"),
      (470069217507,"Melton","Fiona",2,"lectus.cum.sociis@protonmail.com","ut eros non enim commodo hendrerit. Donec porttitor tellus");
    INSERT INTO `students` (`isikucod`,`surname`,`fname`,`grade`,`email`,`message`)
    VALUES
      (511801224752,"Alexander","Larissa",3,"ac.mi@aol.edu","amet, faucibus"),
      (593293118524,"Avila","Lynn",1,"eu.accumsan@google.edu","amet ornare lectus justo eu arcu. Morbi sit"),
      (955178676557,"Zimmerman","Brennan",1,"lacus.varius.et@google.com","tristique aliquet. Phasellus fermentum"),
      (342451774202,"Patton","Ivana",1,"ligula.consectetuer@yahoo.edu","sem. Nulla interdum. Curabitur dictum."),
      (842207849900,"Odom","Murphy",3,"feugiat.metus@hotmail.net","porttitor interdum. Sed auctor odio"),
      (751483026249,"Avila","Blaze",1,"lacus.vestibulum@google.edu","eu erat semper"),
      (139136069691,"Woodward","Quamar",3,"justo.faucibus@hotmail.edu","ut ipsum ac mi eleifend egestas. Sed pharetra, felis"),
      (380899641658,"Cantu","John",1,"libero.at@outlook.net","Vestibulum ante ipsum primis"),
      (758314452541,"Moon","Lev",1,"urna.justo@icloud.org","lacinia vitae, sodales at, velit."),
      (172054648062,"Sweet","Marvin",2,"aliquet@outlook.ca","Duis dignissim tempor arcu. Vestibulum ut eros");
    INSERT INTO `students` (`isikucod`,`surname`,`fname`,`grade`,`email`,`message`)
    VALUES
      (838163461951,"Hicks","Keefe",3,"at.risus.nunc@icloud.org","a feugiat tellus lorem eu metus. In"),
      (768504908503,"Greene","Christine",3,"congue@outlook.org","massa lobortis ultrices. Vivamus rhoncus. Donec"),
      (122369854687,"Berry","Myra",2,"velit.egestas@google.com","ac mattis"),
      (114776652840,"Sherman","Christian",2,"urna@aol.net","ipsum primis in"),
      (361908968559,"Knowles","Dahlia",2,"dictum.placerat.augue@google.ca","sodales elit erat vitae risus. Duis a mi"),
      (945194349278,"Montgomery","Maryam",2,"vestibulum.accumsan.neque@aol.couk","Nunc pulvinar arcu et pede. Nunc sed"),
      (263270805862,"Harris","Vance",3,"nisl.sem@google.couk","nonummy. Fusce fermentum fermentum"),
      (996336194577,"Weiss","Kyla",4,"ut@google.org","sit amet ornare lectus justo eu"),
      (884463412366,"Gill","Coby",3,"in.sodales@outlook.net","Ut tincidunt vehicula"),
      (921032237116,"Morin","Pascale",3,"feugiat.sed.nec@protonmail.edu","aliquam iaculis, lacus pede");
    INSERT INTO `students` (`isikucod`,`surname`,`fname`,`grade`,`email`,`message`)
    VALUES
      (822172725493,"Cameron","Octavia",4,"lorem@hotmail.couk","tortor at risus. Nunc ac sem ut dolor"),
      (745511255345,"Rhodes","Buckminster",4,"est.ac@yahoo.com","volutpat. Nulla dignissim. Maecenas ornare egestas ligula. Nullam feugiat"),
      (304615408866,"Mccullough","Jakeem",2,"tortor.at.risus@protonmail.ca","lobortis quam a felis ullamcorper viverra. Maecenas iaculis aliquet"),
      (466242610867,"Pace","Imani",5,"aliquam@yahoo.ca","montes,"),
      (624126361884,"Michael","Craig",2,"facilisis.vitae@yahoo.org","Nunc pulvinar arcu et pede. Nunc sed orci lobortis"),
      (724491774483,"Cherry","Thane",3,"nunc@aol.couk","fringilla ornare placerat,"),
      (53052166281,"Macdonald","Martin",1,"sed@icloud.org","tristique neque venenatis lacus. Etiam bibendum fermentum"),
      (203846715013,"Kelly","Walter",5,"rhoncus.id@hotmail.couk","tellus. Suspendisse sed dolor. Fusce mi lorem,"),
      (106933456258,"Harrington","Glenna",3,"lectus@outlook.com","mauris eu elit. Nulla facilisi. Sed neque."),
      (396639832139,"Taylor","Gail",1,"cras.vehicula.aliquet@protonmail.ca","amet ultricies sem");
    INSERT INTO `students` (`isikucod`,`surname`,`fname`,`grade`,`email`,`message`)
    VALUES
      (203641684461,"Sherman","Ezra",3,"eget.volutpat.ornare@aol.couk","nec, euismod in,"),
      (891413366531,"Sharp","Janna",3,"praesent.interdum.ligula@protonmail.ca","semper auctor. Mauris vel turpis. Aliquam"),
      (655878636461,"Mccormick","Desirae",1,"mauris.molestie@google.com","nec mauris blandit mattis. Cras eget nisi dictum augue"),
      (488707752446,"Hahn","Charles",3,"ipsum@icloud.ca","nisi dictum augue malesuada malesuada. Integer id magna"),
      (16517411123,"Ewing","Callie",4,"nisl.quisque@google.org","nec orci. Donec"),
      (332252499121,"Greene","Kenneth",2,"aenean.eget@icloud.edu","sem, vitae aliquam eros turpis"),
      (477614769050,"Ingram","Daria",2,"dictum.proin@google.edu","et, magna. Praesent interdum ligula eu enim. Etiam"),
      (19456425530,"Newman","Acton",4,"elit.sed@google.edu","elementum, dui quis"),
      (814888535783,"Franklin","Clarke",4,"eget.mollis@google.couk","Cras"),
      (584120153657,"Daugherty","Oscar",3,"nam.consequat@google.com","lacinia mattis. Integer eu lacus. Quisque imperdiet, erat");
    INSERT INTO `students` (`isikucod`,`surname`,`fname`,`grade`,`email`,`message`)
    VALUES
      (275941936300,"Knight","Miriam",1,"odio.aliquam@yahoo.net","fermentum risus, at"),
      (885481681270,"Whitehead","MacKenzie",2,"facilisis.non@yahoo.com","sapien. Nunc pulvinar arcu et"),
      (351405561509,"Lowery","Sade",2,"lectus@outlook.couk","augue eu tellus."),
      (645823676210,"Nolan","Drew",2,"morbi.metus.vivamus@hotmail.couk","placerat velit. Quisque varius. Nam"),
      (432728157235,"Hobbs","Abigail",4,"enim.consequat@hotmail.edu","urna. Vivamus molestie"),
      (851043631200,"Gibson","Velma",4,"non.hendrerit@protonmail.org","conubia nostra, per inceptos hymenaeos."),
      (249017621049,"Robles","Galena",2,"nulla@icloud.org","vel pede blandit congue."),
      (900233926173,"Barr","Amelia",5,"aliquet.metus@protonmail.couk","tellus faucibus leo, in lobortis tellus justo sit"),
      (651781040657,"Boyd","Mechelle",1,"non.quam@hotmail.ca","malesuada fames"),
      (241212313825,"Mendez","Baker",2,"penatibus.et@hotmail.edu","Phasellus elit pede, malesuada vel, venenatis vel,");
    INSERT INTO `students` (`isikucod`,`surname`,`fname`,`grade`,`email`,`message`)
    VALUES
      (596403548045,"Conley","Xenos",4,"id.sapien.cras@yahoo.org","ligula elit, pretium et, rutrum non, hendrerit id,"),
      (970349039419,"Livingston","MacKenzie",5,"a.sollicitudin@icloud.couk","vitae velit egestas lacinia. Sed"),
      (675334421077,"Martin","Benjamin",2,"facilisis.non@yahoo.couk","vitae velit egestas lacinia. Sed congue, elit sed consequat auctor,"),
      (373254970034,"Nolan","Carla",4,"vivamus.molestie@outlook.org","vulputate, lacus. Cras"),
      (729255691534,"Johnston","Lewis",4,"sed@outlook.ca","vel, faucibus id, libero. Donec consectetuer mauris id sapien."),
      (671459408123,"Henson","Addison",4,"libero.lacus@aol.org","Fusce feugiat. Lorem ipsum dolor sit amet, consectetuer adipiscing"),
      (912109451107,"Solis","Eve",2,"non.dui@google.ca","lacus. Etiam bibendum"),
      (602093602449,"Durham","Daniel",5,"dolor.quisque@icloud.edu","malesuada malesuada. Integer id magna et"),
      (314576407712,"Jensen","Mikayla",3,"lacus@yahoo.org","sed turpis nec mauris"),
      (331857382904,"Guthrie","Abdul",2,"fusce@hotmail.net","Pellentesque habitant morbi tristique senectus");
    ';

    public function init() {
            $connection = (new Connection())->getConnection();
            if(!empty($connection)){
              $this->$connection->exec($this->preQueryCreate);
              $this->$connection->exec($this->preInsert);
            }
            return $connection;
    }
}

