create procedure increment_logincounter(IN UserID Integer) begin
update benutzer
set anzahlanmeldungen = anzahlanmeldungen + 1
where benutzer.id = UserID;
end;