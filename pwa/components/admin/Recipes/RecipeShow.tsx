import {ShowGuesser, FieldGuesser} from "@api-platform/admin";
import {useRecordContext} from "react-admin";
import {Typography} from "@mui/material";

const Preparation = (props: any) => {
  const record = useRecordContext();
  return <>
        <Typography component="pre" variant="body2">
          {record && record.preparation}
        </Typography>
    </>
};

export const RecipeShow = () => (
  <ShowGuesser>
    <FieldGuesser source="name" />
    <FieldGuesser source="info" />
    <FieldGuesser source="ingredients" />
    <FieldGuesser source="rating" />
    <Preparation />
  </ShowGuesser>
);
