import {SelectInput} from "react-admin";

export const RoastLevel = () =>
  <SelectInput source="roastLevel" choices={[
    {id: 'light', name: 'light'},
    {id: 'medium', name: 'medium'},
    {id: 'dark', name: 'dark'},
  ]} />
