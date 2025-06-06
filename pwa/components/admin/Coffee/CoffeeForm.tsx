import {DateInput, SimpleForm, useRecordContext} from "react-admin";
import {Stack, Typography} from "@mui/material";
import {InputGuesser} from "@api-platform/admin";

export const CoffeeForm = () => {
  const record = useRecordContext();
  return (
    <SimpleForm sx={{maxWidth: 1024}}>
      <Typography variant="h4">{record && <span>Edit {record.id}</span> || 'New Coffee'}</Typography>
      <Stack direction="row" gap={2} width="100%">
        <InputGuesser source="roaster" />
        <InputGuesser source="name" />
      </Stack>
      <Stack direction="row" gap={2} width="100%">
        <InputGuesser source="origin" />
        <InputGuesser source="roastLevel" />
        <InputGuesser source="rating" />
      </Stack>
    </SimpleForm>
  );
}
