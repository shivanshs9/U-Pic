<?php include 'db.php';

$sqlTable="
CREATE TABLE users (
  id int(11) NOT NULL,
  sha_id varchar(40) NOT NULL,
  name varchar(32) DEFAULT NULL,
  password varchar(40) NOT NULL,
  email varchar(100) NOT NULL,
  firstname varchar(80) DEFAULT NULL,
  lastname varchar(80) DEFAULT NULL,
  joindate timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8
";

$data = $mysqli->query($sqlTable);

if ($data) {
    echo "'users' created successfully!<br>";
} else {
	echo "ERROR: Cannot create 'users'."  . mysqli_error();
	die();
}

$sqlTable = "
ALTER TABLE users (
	ADD PRIMARY KEY (id),
  ADD UNIQUE KEY name (name,email),
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2
)";

$data = $mysqli->query($sqlTable);

if ($data) {
    echo "'users' altered successfully!<br>";
} else {
	echo "ERROR: Cannot alter 'users'."  . mysqli_error();
	die();
}

$sqlTable = "
CREATE TABLE images (
  id int(11) NOT NULL,
  name varchar(32) NOT NULL,
  image varchar(32) NOT NULL,
  timestamp timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8
";

 $data = $mysqli->query($sqlTable);

if ($data) {
    echo "'images' created successfully!<br>";
} else {
	echo "ERROR: Cannot create 'images'."  . mysqli_error();
	die();
}

$sqlTable = "
ALTER TABLE images
  ADD PRIMARY KEY (id),
  ADD KEY name (name),
  MODIFY id int(11) NOT NULL AUTO_INCREMENT,
  ADD CONSTRAINT images_ibfk_1 FOREIGN KEY (name) REFERENCES users (name) ON DELETE CASCADE ON UPDATE CASCADE
";

 $data = $mysqli->query($sqlTable);

if ($data) {
    echo "'images' altered successfully!<br>";
} else {
	echo "ERROR: Cannot alter 'images'."  . mysqli_error();
	die();
}

?>