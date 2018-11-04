<!DOCTYPE html>
<?php
class GuessGameState {
    public $Counter = 0;
    public $NumberToBeGuessed = -1;
    public const WelcomeMsg = "Wylosowano liczbę z zakresu od 0 do 1000. Proszę ją zgadnąć!";
    private const TooBigMsg = "Podana liczba jest za duża!";
    private const TooSmallMsg = "Podana liczba jest za mała!";
    private const GuessedMsg = "Gratulacje! Poprawnie odgadnięto liczbę w %d krokach!";
    function __construct() {
        $this->NumberToBeGuessed = rand(0,1000);
    }

    function Check($guess) {
        $result = $guess <=> $this->NumberToBeGuessed;
        $this->Counter++;
        switch ($result) {
            case -1: return self::TooSmallMsg; break;
            case 0:
                unset($_SESSION["GameState"]);
                return sprintf(self::GuessedMsg,$this->Counter);
            break;
            case 1: return self::TooBigMsg; break;
        }
    }
}
session_start();
if (!isset($_POST["guess"])) {
    $_SESSION["GameState"] = new GuessGameState();
    $message = GuessGameState::WelcomeMsg;
} else {
    $message = $_SESSION["GameState"]->Check($_POST["guess"]);
}
?>


<html>
    <head>
        <title>A PHP number guessing script</title>
    </head>
    <body>
    <h1><?php echo $message; ?></h1>
        <form action="" method="POST">
        <p>
            <strong>Proszę wpisać liczbę:</strong>
            <input type="text" name="guess">
        </p>
        <p>
            <input type="hidden" name="numtobeguessed" value="<?php echo $_POST["numtobeguessed"]; ?>" >
            </p>
        <p>
            <input type="submit" value="OK"/>
        </p>
        </form>
    </body>
</html>