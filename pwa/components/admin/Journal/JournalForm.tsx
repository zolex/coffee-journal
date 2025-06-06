import {DateInput, SimpleForm, useRecordContext} from "react-admin";
import {Stack, Typography} from "@mui/material";
import {InputGuesser} from "@api-platform/admin";

export const JournalForm = () => {
  const record = useRecordContext();
  return (
    <SimpleForm sx={{maxWidth: 1024}}>
      <Typography variant="h4">{record && <span>Edit {record.id}</span> || 'New Journal'}</Typography>
      <Stack direction="row" gap={2} width="100%">
        <InputGuesser source="type"/>
        <InputGuesser source="coffee"/>
      </Stack>
      <Stack direction="row" gap={2} width="100%">
        <InputGuesser source="powderWeight"/>
        <InputGuesser source="brewedWeight"/>
        <InputGuesser source="grindLevel"/>
        <InputGuesser source="grindDuration"/>
      </Stack>
      <Stack direction="row" gap={2} width="100%">
        <InputGuesser source="pressure"/>
        <InputGuesser source="duration"/>
        <InputGuesser source="temperature"/>
      </Stack>
      <Stack direction="row" gap={2} width="100%">
        <DateInput source="date" readOnly={!!record}/>
        <InputGuesser source="beanAge"/>
        <InputGuesser source="rating"/>
      </Stack>
    </SimpleForm>
  );
}
