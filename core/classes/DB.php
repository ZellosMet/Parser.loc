<?

class DB
{
    private $connection;
    private PDOStatement $stnt;
    private static $instance = null;
    private function __conctruct() {}

    //функция для создания подключения
    public function GetConnection(array $db_config)
    {
        $dsn = "mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset={$db_config['charset']}";

        try 
        {
            $this->connection = new PDO($dsn, $db_config['username'], $db_config['password'], $db_config['options']);
            return $this;
        } 
        catch (PDOException $e) 
        {
            Abort(500);
        }
    }

    //Функция проверки существования объекта
    public static function GetInstance()
    {
        if(self::$instance === null)
            self::$instance = new self();
        return self::$instance;
    }

    //Метод для выполнения запросов
    public function query($query, $params = [])
    {
        try 
        {
            $this->stnt = $this->connection->prepare($query);
            $this->stnt->execute($params);
        } 
        catch (PDOException $e) 
        {
            return false;
        }        
        return $this;
    }

    //Метод для получение всех записей    
    public function FindAll()
    {
        return $this->stnt->fetchAll();
    }

    //Для получения одной записи
    public function Find()
    {
        return $this->stnt->fetch();
    }

    //Для получения одной записи с отменой если ничего не найдено
    public function FindOrAbord()
    {
        $res = $this->stnt->Find();
        if(!$res)
            Abort();
        return $res;
    }
}

?>