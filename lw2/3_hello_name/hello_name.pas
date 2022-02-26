PROGRAM HelloName(INPUT, OUTPUT);
USES
	DOS;
VAR
	Param: STRING;
BEGIN
	WRITELN('Content-Type: text/plain');
	WRITELN;
	IF Copy(GetEnv('QUERY_STRING'), 1, 5) = 'name='
	THEN
		BEGIN
			Param := Copy(GetEnv('QUERY_STRING'), 6, Length(GetEnv('QUERY_STRING')));
			IF Length(Param) <> 0
			THEN
				WRITELN('Hello, dear ', Param, '!')
			ELSE
				WRITELN('Hello Anonymous!')
		END
	ELSE
		WRITELN('Hello Anonymous!')
END.