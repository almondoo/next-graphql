import { gql } from '@apollo/client';

export const CREATE_TASKS_QUERY = gql`
  query CreateTask($id: Int!) {
    deleteTask(id: $id)
  }
`;

export interface TaskData {}
