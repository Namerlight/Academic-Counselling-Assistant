function autoSuggestion($username)
{

$user = User::where('username', $username)->first();
$academicInfo = Student::where('username', $username)->first();

echo $academicInfo;

}