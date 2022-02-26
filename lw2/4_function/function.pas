PROGRAM WorkWithQueryString(INPUT, OUTPUT);
USES
	DOS;

FUNCTION GetQueryStringParameter(Key:STRING): STRING;
VAR
	Query, SubQuery, RemainderQuery, ParameterName, ParameterValue: STRING;
BEGIN
	Query := GetEnv('QUERY_STRING');
	IF Length(Query) > 0 
	THEN
		BEGIN
			{GetQueryStringParameter := Copy(Query, Length(Key)+2, Length(Query))}
			RemainderQuery := Query;
			WHILE Pos('&', RemainderQuery) > 0
			DO
				BEGIN
					IF Pos('&', RemainderQuery) <> 1
					THEN
						BEGIN
							SubQuery := Copy(RemainderQuery, 1, Pos('&', RemainderQuery) - 1);
							IF Pos('=', SubQuery) > 0
							THEN
								BEGIN
									ParameterName := Copy(SubQuery, 1, Pos('=', SubQuery) - 1);
									ParameterValue := Copy(SubQuery, Pos('=', SubQuery) + 1, Length(SubQuery));
									IF Key = ParameterName
									THEN
										BEGIN
											GetQueryStringParameter := ParameterValue;
											{Нужный параметр найден, при значении RemainderQuery = 'Finded' цикл завершается}
											RemainderQuery := 'Finded' 
										END
									ELSE
										RemainderQuery := Copy(RemainderQuery, Pos('&', RemainderQuery) + 1, Length(RemainderQuery))
								END
						END
					ELSE
						{Обработчик для случая, если в строке параметров встречается && подряд (завершение цикла).
						Например: ?first_name=ivan&&second_name=ivanjd}
						BEGIN
							GetQueryStringParameter := 'WRONG QUERY_STRING!';
							RemainderQuery := 'Wrong'
						END
				END;

			{Обработка последнего параметра после выполнения цикла}
			IF (RemainderQuery <> 'Finded') AND (RemainderQuery <> 'Wrong')
			THEN
				IF Pos('=', RemainderQuery) > 0
				THEN
					BEGIN
						ParameterName := Copy(RemainderQuery, 1, Pos('=', RemainderQuery) - 1);
						ParameterValue := Copy(RemainderQuery, Pos('=', RemainderQuery) + 1, Length(RemainderQuery));
						IF Key = ParameterName
						THEN
							GetQueryStringParameter := ParameterValue
						ELSE
							GetQueryStringParameter := 'NO SUCH KEY'
					END 			
		END
	ELSE
		GetQueryStringParameter := 'NO QUERY_STRING'
END;

BEGIN
	WRITELN('Content-Type: text/plain');
	WRITELN;
	WRITELN('first_name: ', GetQueryStringParameter('first_name'));
	WRITELN('last_name: ', GetQueryStringParameter('last_name'));
	WRITELN('age: ', GetQueryStringParameter('age'));
	WRITELN('QUERY_STRING: ', GetEnv('QUERY_STRING'))
END.