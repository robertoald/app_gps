var sesion;
window.onload = resetTimer;
document.onkeypress = resetTimer;
document.onmousemove = resetTimer;
function logout()
{
    window.location = '../Config/includes/LogIn.php?accion=out_admin';
}
function resetTimer()
{
    clearTimeout(sesion);
    sesion = setTimeout(logout, 900000); //15 minutos de inactividad
}