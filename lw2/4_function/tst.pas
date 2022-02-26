PROGRAM Test(INPUT, OUTPUT);
VAR
	Str, SubStr, RemainderStr, Key, Val: STRING;
BEGIN
	WRITE('VVOD: ');
	READ(Str);
	WRITELN(Str);
	WRITELN('Vyvod: ');
	RemainderStr := Str;
	WHILE Pos('&', RemainderStr) > 0
	DO
		BEGIN
			IF Pos('&', RemainderStr) <> 1
			THEN 
				BEGIN
					SubStr := Copy(RemainderStr, 1, Pos('&', RemainderStr) - 1);
					WRITELN('SubStr: ', SubStr);
					IF Pos('=', SubStr) > 0
					THEN
						BEGIN
							Key := Copy(SubStr, 1, Pos('=', SubStr) - 1);
							IF Length(Key) = 0
							THEN
								Key := 'Empty Key';
							Val := Copy(SubStr, Pos('=', SubStr) + 1, Length(SubStr));
							IF Length(Val) = 0
							THEN
								Val := 'Empty Val';
							WRITELN('Key: ', Key, ' Val: ', Val, ' Pos =: ', Pos('=', SubStr))
						END
					ELSE
						WRITELN('Empty param');
					RemainderStr := Copy(RemainderStr, Pos('&', RemainderStr) + 1, Length(RemainderStr));
				END
			ELSE
				BEGIN
					WRITELN('Error');
					RemainderStr := Copy(RemainderStr, Pos('&', RemainderStr) + 1, Length(RemainderStr))
				END
		END;

	SubStr := Copy(RemainderStr, 1, Length(RemainderStr));
	WRITELN('Last SubStr: ', SubStr);
	IF Pos('=', SubStr) > 0
	THEN
		BEGIN
			Key := Copy(SubStr, 1, Pos('=', SubStr) - 1);
			Val := Copy(SubStr, Pos('=', SubStr) + 1, Length(SubStr));
			WRITELN('Key: ', Key, ' Val: ', Val, ' Pos =: ', Pos('=', SubStr))
		END
	ELSE
		WRITELN('Empty param')

END.