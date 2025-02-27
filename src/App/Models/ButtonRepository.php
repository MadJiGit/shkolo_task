<?php

namespace App\Models;

use App\Interfaces\ButtonRepositoryInterface;
use Exception;

class ButtonRepository implements ButtonRepositoryInterface
{
    private \mysqli $conn;
    private string $table_name;

    /**
     * @throws Exception
     */
    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
        $this->table_name = 'buttons_data';
        $this->createTable();
    }

    /**
     * @return void
     * @throws Exception
     * create table if not exists
     */
    private function createTable(): void
    {
        $sql_table = "CREATE TABLE IF NOT EXISTS $this->table_name (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            link VARCHAR(255) NOT NULL,
            color VARCHAR(50) NOT NULL,
            date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;";


        if (!$this->conn->query($sql_table)) {
            throw new Exception('Error creating table: ' . $this->conn->error);
        }

        // check if table is empty
        $sql_exist_data = "SELECT EXISTS (SELECT 1 FROM $this->table_name);";

        $stmt = $this->conn->query($sql_exist_data);
        $res = $stmt->fetch_row();

        // add default data into table
        // only if table is empty
        if ($res[0] === '0'){
            $sql_data = "INSERT INTO $this->table_name (`id`, `title`, `link`, `color`) VALUES
                                                 (1, '', '', 'white'),
                                                 (2, '', '', 'white'),
                                                 (3, '', '', 'white'),
                                                 (4, '', '', 'white'),
                                                 (5, '', '', 'white'),
                                                 (6, '', '', 'white'),
                                                 (7, '', '', 'white'),
                                                 (8, '', '', 'white'),
                                                 (9, '', '', 'white');";

            if (!$this->conn->query($sql_data)) {
                throw new Exception('Error fill table with data: ' . $this->conn->error);
            }
        }
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        $sql = "SELECT * FROM $this->table_name ORDER BY id";
        $stmt = $this->conn->query($sql);
        $buttons = [];

        if ($stmt->num_rows > 0) {
            while ($row = $stmt->fetch_assoc()) {
                $buttons[$row['id']] = $row;
            }
        }

        $stmt->close();

        return $buttons;
    }

    /**
     * @param $id
     * @return array|null
     */
    public function findById($id): array|null
    {
        $sql = "SELECT * FROM $this->table_name WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt->close();

        return $result->fetch_assoc();
    }

    /**
     * @throws Exception
     */
    public function save($data): bool
    {
        $sql = "UPDATE $this->table_name SET title = ?, link = ?, color = ?, last_updated = NOW() WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $data['title'], $data['link'], $data['color'], $data['id']);

        if (!$stmt->execute()) {
            throw new Exception('Error saving button: ' . $this->conn->error);
        }

        $stmt->close();

        return true;
    }


    /**
     * @throws Exception
     */
    public function update(array $data): bool
    {
        $sql = "INSERT INTO $this->table_name (title, link, color, date_created, last_updated) VALUES (?, ?, ?, NOW(), NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $data['title'], $data['link'], $data['color']);

        if (!$stmt->execute()) {
            throw new Exception('Error save button: ' . $this->conn->error);
        }

        $stmt->close();

        return $this->conn->insert_id;
    }

    /**
     * @param $id
     * @return void
     */
    public function clearById($id): void
    {
        $sql = "UPDATE $this->table_name SET title = '', link = '', color = 'white', last_updated = NOW() WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $stmt->close();
    }
}
