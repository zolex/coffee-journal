import {
  ArrayInput,
  NumberInput,
  SelectInput,
  SimpleForm,
  SimpleFormIterator,
  useGetList,
  useRecordContext
} from "react-admin";
import {Stack, Typography} from "@mui/material";
import {InputGuesser} from "@api-platform/admin";

export const CoffeeForm = () => {
  const record = useRecordContext();
  const { data: beanTypes, isPending: beanTypesPending } = useGetList('bean_types');
  return (
    <SimpleForm sx={{maxWidth: 1024}}>
      <Typography variant="h4">{record && <span>Edit {record.id}</span> || 'Create Coffee'}</Typography>
      <Stack direction="row" gap={2} width="100%">
        <InputGuesser source="roaster" />
        <InputGuesser source="name" />
      </Stack>
      <Stack direction="row" gap={2} width="100%">
        <InputGuesser source="origin" />
        <InputGuesser source="roastLevel" />
        <InputGuesser source="rating" />
      </Stack>
      <ArrayInput source="beans">
        <SimpleFormIterator inline>
          <Stack direction="row" gap={2} width="100%">
            <SelectInput
              source="type"
              choices={beanTypes}
              optionText="name"
              optionValue="code"
              isPending={beanTypesPending}
            />
            <NumberInput source="percent" />
          </Stack>
        </SimpleFormIterator>
      </ArrayInput>


    </SimpleForm>
  );
}
